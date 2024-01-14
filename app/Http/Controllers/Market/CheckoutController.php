<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Address;
use App\Models\Market\DiscountCode;
use App\Models\Market\Province;
use App\Models\Market\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userShoppingCart = auth()->user()->shoppingCart()->first();
        $shoppingCartItems = $userShoppingCart->items;
        $provinces = Province::all();

        $shippingMethods = ShippingMethod::all();
        $addresses = Auth::user()->addresses;
        return view('app.shopping-cart.checkout.index', compact('shoppingCartItems', 'addresses', 'shippingMethods', 'provinces'));
    }


    public function getAmounts(Request $request)
    {

        [$totalAmount, $discountAmount] = $this->getShoppingCartAmount();
        
        $shippingMethodAmount = false;
        $discountCodeAmount = 0;

        if ($request->filled('discount_code')) {
            $discountCodeAmount = $this->checkAndCalcDiscount($request->get('discount_code'), $totalAmount);
        }

        if ($request->filled('shipping_method_id')) {
            $shippingMethod = ShippingMethod::find($request->get('shipping_method_id'));
            if ($shippingMethod) {
                $shippingMethodAmount = $shippingMethod->price;
                $totalAmount += $shippingMethodAmount;
            }
        }

        $discountAmount += $discountCodeAmount;
        $totalAmount -= $discountCodeAmount;

        return response()->json(['total_amount' => $totalAmount, 'discount_amount' => $discountAmount, 'discount_code_amount' => $discountCodeAmount , 'shipping_method_amount' => $shippingMethodAmount]);
    }


    private function getShoppingCartAmount()
    {
        $shoppingCartItems = Auth::user()->shoppingCart()->first()->items;

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

                return  $discount;
            }
        }

        return 0;
    }


}
