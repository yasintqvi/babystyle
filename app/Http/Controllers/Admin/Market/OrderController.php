<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(15); // تعداد پیش‌فرض 15
        return view('admin.market.order.index', compact('orders'));
    }

    public function fetch()
    {
        $orders = Order::query()->latest();

        if ($keyword = request('search')) {
            $orders->search($keyword); // اطمینان از اینکه scope search در مدل تعریف شده
        }

        if ($status = request('status')) {
            switch ($status) {
                case 'delivered':
                    $orders->where('order_status', 3);
                    break;
                case 'processing':
                    $orders->where('order_status', 2);
                    break;
                case 'order_confirm':
                    $orders->where('order_status', 1);
                    break;
                case 'unpaid':
                    $orders->where('order_status', 0);
                    break;
            }
        }

        $perPageItems = (int) request('paginate') ?: 15;
        $orders = $orders->paginate($perPageItems);

        return response()->json($orders); // اینجا JSON
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:0,1,2,3'
        ]);

        // set delivered order
        $order->update([
            'order_status' => $request->get('order_status')
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.market.order.show', compact('order'));
    }

    public function saveTrackingCode(Request $request, Order $order)
    {
        $request->validate([
            'tracking_code' => 'required|string|max:255',
        ]);

        $order->tracking_code = $request->tracking_code;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'کد رهگیری با موفقیت ثبت شد.'
        ]);
    }

}
