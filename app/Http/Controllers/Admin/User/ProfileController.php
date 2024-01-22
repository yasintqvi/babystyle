<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.user.profile.index' , ['user' => auth()->user()]);
    }
    
    public function security()
    {
        return view('admin.user.profile.security' , ['user' => auth()->user()]);
    }

    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => ['nullable', Rule::unique('users' , 'email')->ignore($user->id),'email'],
            'phone_number' => ['required', 'numeric' , Rule::unique('users' , 'phone_number')->ignore($user->id), 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11'],
        ]);

        $validated['phone_number'] = formatPhoneNumber($request->phone_number);
        $user->update($validated);
        return redirect()->back()->with('success', "کاربر  با موفقیت ویرایش شد.");        
    }
    
}
