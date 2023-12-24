<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('verify')) {
                return to_route('login.form');
            }

            $userAllowedLoginOtpMethod = session()->get('verify')['allowed_otp_method']; 
            if (!$userAllowedLoginOtpMethod) {
                return to_route('login.form');
            }

            return $next($request);
        });   

    }

    public function show()
    {
        $verify = session()->get('verify');

        session()->reflash();

        return view('auth.otp-verify', compact('verify'));
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric|digits:5'
        ]);

        if ($validator->fails()) {
            
            $request->session()->reflash();

            return back()->with(['error' => 'کد وارد شده نادرست است.']);
        }

        $getVerifyInfo = $request->session()->get('verify');

        $user = User::findOrFail($getVerifyInfo['user_id']);

        $otpCode = $user->getActiveOtpCode();

        if (is_null($otpCode)) {
            $request->session()->reflash();

            return back()->with(['error' => 'کد منقضی شده است.']);
        }
        else if ($request->get('code') !== $otpCode->code) {
    
            $request->session()->reflash();

            return back()->with(['error' => 'کد وارد شده نادرست است.']);
        }

        $otpCode->delete();

        Auth::loginUsingId($user->id);

        return to_route('home')->with('success', 'شما وارد حساب کاربری شدید.');

    }

    public function resend(Request $request)
    {

        $request->session()->reflash();

        $verify = $request->session()->get('verify');

        $user = User::findOrFail($verify['user_id']);

        if ($user->hasActiveOtpCode()) {
            return response()->json(['status' => 'warning', 'message' => "صبر کن ! ممکنه کد یکم دیر به دستت برسه :)"], 200);
        }

        $user->generateOtpCode();

        return response()->json(['status' => 'success', 'message' => "کد تایید مجددا ارسال گردید."], 200);

    }

}
