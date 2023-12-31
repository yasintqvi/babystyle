<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PasswordController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('verify')) {
                return to_route('login.form');
            }

            return $next($request);
        });
    }

    public function show()
    {
        session()->reflash();

        return view('auth.password-verify');
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:64'
        ]);

        if ($validator->fails()) {

            $request->session()->reflash();

            return back()->with(['error' => 'کلمه عبور اشتباه است.']);
        }

        $getVerifyInfo = $request->session()->get('verify');

        $user = User::findOrFail($getVerifyInfo['user_id']);

        $password = $request->get('password');

        if (!Hash::check($password, $user->password)) {
            $request->session()->reflash();

            return back()->with(['error' => 'کلمه عبور اشتباه است.']);
        }

        Auth::loginUsingId($user->id);

        return redirect(request()->query('backUrl') ?? '/')->with('success', 'شما وارد حساب کاربری شدید.');

    }
}