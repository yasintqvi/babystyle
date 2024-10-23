<?php

namespace App\Http\Controllers;

use App\Http\Requests\Market\OrderRequest;
use App\Models\Market\Address;
use App\Models\Market\DiscountCode;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderLine;
use App\Models\Market\ShippingMethod;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Zarinpal\ZarinpalService;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query();

        switch (request('status')) {
            case 'unpaid':
                $orders->where('order_status', 0);
                break;

            case 'order_confirm':
                $orders->where('order_status', 1);
                break;

            case 'processing':
                $orders->where('order_status', 2);
                break;

            case 'delivered':
                $orders->where('order_status', 3);
                break;

            default:
                $orders->where('order_status', 1);
                break;
        }

        $orderCounts = [
            'unpaid' => Order::where('user_id', auth()->user()->id)->where('order_status', 0)->count(),
            'order_confirm' => Order::where('user_id', auth()->user()->id)->where('order_status', 1)->count(),
            'processing' => Order::where('user_id', auth()->user()->id)->where('order_status', 2)->count(),
            'delivered' => Order::where('user_id', auth()->user()->id)->where('order_status', 3)->count(),
        ];

        $orders = $orders->where('user_id', auth()->user()->id)->latest()->get();

        return view('app.profile.order.index', compact('orders', 'orderCounts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {

        $order = DB::transaction(function () use ($request) {

            $shippingAmount = ShippingMethod::find($request->get('shipping_method_id'))->price;
            [$totalProductsAmount, $orderDiscountAmount] = $this->getShoppingCartAmount();

            if ($request->filled('discount_code')) {
                $orderDiscountAmount += $this->checkAndCalcDiscount($request->get('discount_code'), $totalProductsAmount);
            }

            $finalAmount = ($totalProductsAmount - $orderDiscountAmount) + $shippingAmount;

            $address = Address::find($request->get('address_id'));

            $order = $request->user()->orders()->create([
                'shipping_method_id' => $request->get('shipping_method_id'),
                'address_id' => $address->id,
                'shipping_address' => $address->address,
                'shipping_amount' => (int) $shippingAmount,
                'total_products_amount' => (int) $totalProductsAmount,
                'order_discount' => (int) $orderDiscountAmount,
                'final_amount' => (int) $finalAmount,
                'order_date' => now()
            ]);

            $request->user()->update([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name')
            ]);

            $this->clearShoppingCartItems($order);

            return $order;
        });

        return $this->directToBank($order);
    }

    private function clearShoppingCartItems(Order $order)
    {
        $shoppingCartItems = Auth::user()->shoppingCart()->first()->items;

        foreach ($shoppingCartItems as $shoppingCartItem) {
            $order->lines()->create([
                'product_item_id' => $shoppingCartItem->product_item_id,
                'quantity' => $shoppingCartItem->quantity,
                'price' => $shoppingCartItem->productItem->price_with_discount
            ]);

            $shoppingCartItem->delete();
        }
    }

    private function getShoppingCartAmount()
    {
        $shoppingCartItems = auth()->user()->shoppingCart()->first()->items;

        if ($shoppingCartItems->isEmpty()) {
            return response()->json(['total_amount' => 0, 'discount_amount' => 0]);
        }

        $totalAmount = 0;
        $discountAmount = 0;

        foreach ($shoppingCartItems as $shoppingCartItem) {
            $productItem = $shoppingCartItem->productItem;
            if ($productItem->quantity > 0) {
                $discountAmount += ($productItem->price - $productItem->price_with_discount) * $shoppingCartItem->quantity;
                $totalAmount += $productItem->price * $shoppingCartItem->quantity;
            }
        }

        return [$totalAmount, $discountAmount];
    }

    private function checkAndCalcDiscount($discountCode, $totalAmount)
    {
        $discountCode = DiscountCode::where('code', $discountCode)->first();

        if ($discountCode) {
            if ($discountCode->isActive()) {

                $maxDiscountAmount = $discountCode->discount_ceiling;

                $discount = 0;

                if ($discountCode->type == 0) {
                    $percentage = $discountCode->discount_rate;
                    $discount = $totalAmount * ($percentage / 100);

                    $discount = min($discount, $maxDiscountAmount ?? $discount);
                } else {
                    $discount = min($discountCode->amount, $discountCode->discount_ceiling ?? $discountCode->amount);
                }

                return $discount;
            }
        }

        return 0;
    }

    public function result(Request $request)
    {
        if (session()->has('redirected')) {
            return to_route('profile.orders.index');
        }

        session()->flash('redirected');

        $amount = $request->get('amount');
        $onlinePaymentId = $request->get('payment_id');

        $zp = new ZarinpalService();
        $result = $zp->verify($amount);

        $status = isset($result["Status"]) && $result["Status"] == 100;

        $payment = OnlinePayment::findOrFail($onlinePaymentId);

        $order = Order::where('online_payment_id', $payment->id)->first();

        $payment->update([
            'trans_id' => $request['RefID'],
            'is_succeed' => $status ? 1 : 0,
            'is_processed' => 0,
            'bank_first_response' => json_encode($result)
        ]);

        $order->update([
            'order_status' => $status ? 1 : 0
        ]);



            // کاهش موجودی کالا
            $order->lines->map(function ($orderLine) {
                $productItem = $orderLine->productItem;
                $productItem->update([
                    'quantity' => $productItem->quantity - $orderLine->quantity
                ]);
                $productItem->product->update([
                    'quantity' => $productItem->product->quantity - $orderLine->quantity
                ]);
            });

            if ($status) {
                $order->user->notify(new NewOrderNotification($order));
            }

        return view('app.profile.order.result', compact('result', 'status'));
    }


    private function directToBank(Order $order)
    {
        $payment = Auth::user()->payments()->create([
            'amount' => $order->final_amount,
            'gateway' => 'زرین پال',
            'is_processed' => 1,
            'is_succeed' => 0,
        ]);

        $order->update([
            'online_payment_id' => $payment->id
        ]);

        $Amount = $order->final_amount;
        $Description = "تراکنش زرین پال";
        $Email = "";
        $Mobile = Auth::user()->mobile;

        $CallbackURL = route('orders.result', ['amount' => $order->final_amount, 'payment_id' => $order->online_payment_id]);

        $zp = new ZarinpalService();
        $result = $zp->request($Amount, $Description, $Email, $Mobile, $CallbackURL);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            session()->put('bank_verify', true);
            $zp->redirect($result["StartPay"]);
        } else {
            return back()->with('error', "خطا در ایجاد تراکنش");
        }
    }

}
