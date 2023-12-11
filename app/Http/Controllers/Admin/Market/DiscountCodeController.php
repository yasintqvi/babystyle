<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\DiscountCodeRequest;
use App\Models\Market\DiscountCode;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.market.discount-code.index');
    }

    public function fetch()
    {
        $discountCodes = DiscountCode::query()->latest();

        if ($keyword = request('search')) {
            $discountCodes->search($keyword);
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $discountCodes = $discountCodes->paginate($perPageItems);



        return response()->json($discountCodes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.discount-code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountCodeRequest $request)
    {
        $inputs = $request->all();

        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

        
        $discountCode = DiscountCode::create($inputs);

        return to_route('admin.market.discount-codes.index')->with('success', "کد تخفیف مورد نظر با موفقیت ایجاد شد.");

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
    public function edit(DiscountCode $discountCode)
    {
        return view('admin.market.discount-code.edit'  , compact('discountCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountCodeRequest $request, DiscountCode $discountCode)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

        $realTimestampStart = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

        $discountCode->update($inputs);
        return to_route('admin.market.discount-codes.index')->with('success', "کد تخفیف مورد نظر با موفقیت ویرایش شد.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountCode $discountCode)
    {
        $discountCode->delete();
        return back()->with('cute-success', 'کد تخفیف حذف گردید.');
    }

    public function batchDelete(Request $request)
    {
        $request->validate([
            'ids.*' => 'required|exists:faqs,id',
        ]);

        // TODO check faq relations

        DiscountCode::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف کد تخفیف با موفقیت انجام شد.");
    }
}
