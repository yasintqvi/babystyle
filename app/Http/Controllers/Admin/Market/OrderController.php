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
        return view('admin.market.order.index');
    }

    /**
     * Fetch order data
     */
    public function fetch()
    {
        $orders = Order::query()->latest();

        if ($keyword = request('search')) {
            $orders->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $orders->active() : $orders->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $orders = $orders->paginate($perPageItems);

        return response()->json($orders);
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

}
