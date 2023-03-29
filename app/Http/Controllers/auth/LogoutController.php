<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logoutApi(Request $request)
    {
        try {
            session()->pull('logged_in_user');
            Auth::logout();
            return redirect('/');
        } catch (\Exception $e) {
            return throwException($e, 'logoutApi', $request->api_request_id);
        }
    }
}
