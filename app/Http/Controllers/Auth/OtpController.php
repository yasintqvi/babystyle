<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function show()
    {
        if (!session()->has('verify')) {
            return back();
        }

        $verify = session()->get('verify');
        
        return view('auth.otp-verify', compact('verify'));
    }

    public function login() 
    {

    }

    public function resend(Request $request)
    {
        if ($request->has('verify')) {
            
            $verify = $request->get('verify');

            if ($verify['code_expire'] > 0) {
                return response()->json(['status' => 'warning', 'message' => "شما بعد از {$verify['code_expire']} ثانیه مجاز به درخواست کد جدید هستید."], 200);
            }
            
            return response()->json(['status' => 'success', 'message' => "کد تایید مجددا ارسال گردید."], 200);
        }

        return response()->json(['status' => 'error', 'message' => "درخواست شما نا معتبر است"]);

    }

}
