<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request , User $user): RedirectResponse
    {
        $this->validation['password'] = ['required', 'confirmed', Rules\Password::defaults()];

        if ($request->user()->id == $user->id)
            return $this->changeYourPassword($request);


        return $this->changeOtherUserPassword($request , $user);
    }

    private function changeYourPassword($request)
    {
        $this->validation['old_password'] = 'required';

        $validated  = $request->validate($this->validation);
        
        if (!Hash::check($validated['old_password'] , auth()->user()->password))
            return back()->with('toast-error' , 'کلمه عبور فعلی اشتباه است.');


        auth()->user()->update([
            'password'  =>   $validated['password']
        ]);

        return back()->with('toast-success' , 'کلمه عبور تغییر یافت.'); 
    }
    

    private function changeOtherUserPassword($request,User $user)
    {
        $validated = $request->validate($this->validation);

        $user->update([
            'password'  =>   Hash::make($validated['password'])
        ]);

        return back()->with('toast-success' , 'کلمه عبور تغییر یافت.'); 
    }
}
