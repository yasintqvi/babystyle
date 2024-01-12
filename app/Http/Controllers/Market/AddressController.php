<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\AddressRequest;
use App\Http\Requests\Market\UpdateAddressRequest;
use App\Models\Market\Address;
use App\Models\Market\City;
use App\Models\Market\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        $provinces = Province::all();
        return view('app.profile.addresses' , compact('addresses' , 'provinces'));
    }

    public function store(AddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        $address = Address::create($inputs);
        return back()->with('success' , 'آدرس شما با موفقیت ثبت شد');

    }

    public function update(AddressRequest $request, Address $address)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        $address->update($inputs);
        return back()->with('success' , 'آدرس شما با موفقیت ویرایش شد');
    }

    public function getProvinceCitiesList(Request $request)
    {
        $cities = City::where('province_id' , $request->province_id)->get();
        return $cities;
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return back()->with('success', 'آدرس مورد نظر حذف شد');
    }
}
