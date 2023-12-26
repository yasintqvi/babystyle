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
        $this->validation['password'] = ['required', 'confirmed' , 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%])/' , Rules\Password::defaults()];

        return $this->changeOtherUserPassword($request , $user);
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
