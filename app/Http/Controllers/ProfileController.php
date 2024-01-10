<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->with('items.discounts')->get();
        return view("app.profile.index" , compact('products'));
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
    public function edit(Request $request)
    {
        return view("app.profile.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $validData = $request->validated();

        $request->user()->update($validData);

        $messages = [
            'success' => 'اطلاعات حساب کاربری بروز رسانی شد.'
        ];

        // if the user wants to change her password
        if ($request->filled('password')) {

            $request->validate([
                'current_password' => $request->user()->password ? 'required_if:password,!=,' : 'nullable',
                'password' => 'nullable|min:8|max:64|confirmed',
            ]);

            $passwordVerify = isset($request->user()->password) ? Hash::check($request->get('current_password'), $request->user()->password) : true;

            if ($passwordVerify) {
                $request->user()->update(['password' => Hash::make($request->password)]);
            }
            else {
                $messages['error'] = 'کلمه عبور فعلی مطابقت ندارد.';
            }

        }
        
        return back()->with($messages);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
