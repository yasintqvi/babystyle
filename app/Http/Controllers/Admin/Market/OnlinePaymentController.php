<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use Illuminate\Http\Request;

class OnlinePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.market.payment.index');  
    }

    /**
     * Display the specified resource.
     */
    public function fetch()
    {
        $payments = OnlinePayment::query()->latest();

        if ($keyword = request('search')) {
            $payments->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $payments->active() : $payments->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $payments = $payments->paginate($perPageItems);

        return response()->json($payments);
    }


    public function show(OnlinePayment $onlinePayment)
    {
        $bankResponses = collect(json_decode($onlinePayment->bank_first_response))->toArray();
        
        return view('admin.market.payment.show', compact('onlinePayment', 'bankResponses'));
    }

}
