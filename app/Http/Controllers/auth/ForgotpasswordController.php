<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotpasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendEmailToRecoverPassword(Request $request)
    {
        try{
            dd('Reover Password');
        } catch(\Exception) {

        }
    }
}
