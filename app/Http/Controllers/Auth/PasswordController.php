<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function show()
    {
        if (!session()->has('verify')) {
            return back();
        }

        return view('auth.otp-verify');
    }


    public function login()
    {

    }
}
