<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\ShippingMethodRequest;
use App\Models\Market\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.market.shipping-methods.index');
    }

    public function fetch()
    {
        $shippingMethodes = ShippingMethod::query()->latest();

        if ($keyword = request('search')) {
            $shippingMethodes->search($keyword);
        }

        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $shippingMethodes = $shippingMethodes->paginate($perPageItems);

        return response()->json($shippingMethodes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.shipping-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingMethodRequest $request)
    {
        $shippingMethode = ShippingMethod::create($request->all());

        return to_route('admin.market.shipping-methods.index')->with('success', "روش ارسال $shippingMethode->name با موفقیت اضافه شد.");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.market.shipping-methods.edit' , compact('shippingMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {

        $shippingMethod->update($request->all());

        return to_route('admin.market.shipping-methods.index')->with('success', "روش ارسال مورد نظر با موفقیت بروز رسانی شد.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();

        return back()->with('success', "حذف روش ارسال با موفقیت انجام شد.");        
    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:shipping_methods,id',
        ]);

        // TODO check ShippingMethod relations

        ShippingMethod::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف روش ارسال با موفقیت انجام شد.");
    }
}
