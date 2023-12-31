<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\OTPSms;
use Illuminate\Support\Facades\Auth;

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

        $request->session()->flash('verify', ['allowed_otp_method' => $user->userCanLoginOtp(), 'user_id' => $user->id, 'phone_number' => $user->phone_number]);
        
        if ($user->is_admin || $user->is_staff) {
            return to_route("login.password.show", ['backUrl' => $request->query('backUrl')]);
        }

        $user->generateOtpCode();
    
        return to_route("login.otp.show");

    }

    public function logout()
    {
        Auth::logout();
        
        return back()->with('success', 'شما از حساب کاربری خارج شدید.');
    }

}
