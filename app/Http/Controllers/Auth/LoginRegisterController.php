<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class LoginRegisterController extends Controller
{

    public function form()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {

        if (!preg_match('/^(\+98|98|0)9\d{9}$/', $request->get('phone_number'))) {
            return back()->with(['phone_number_error' => 'شماره تلفن نامعتبر می باشد.']);
        }

        $phoneNumber = formatPhoneNumber($request->get('phone_number'));

        $user = User::where('phone_number', $phoneNumber)->first();

        if (empty($user)) {
            $user = User::create([
                'phone_number' => $phoneNumber
            ]);
        }

        
        if (isset($user->phone_verified_at) && isset($user->password)) {

            $request->session()->flash('verify', collect($user)->toArray());
            
            return to_route("login.password.show");
        }

        $otpCode = $user->generateOtpCode();

        $expire = dateSubtration($otpCode->expired_at, now());

        $request->session()->flash('verify', ['code_expire' => $expire, ...collect($user)->toArray()]);

        return to_route("login.otp.show");

    }

}
