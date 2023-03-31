<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logoutApi(Request $request)
    {
        try {
            $token = $request->user()->token();
            $token->revoke();
            session()->pull('logged_in_user');
            $response = ['message' => 'User have been successfully logged out!'];
            return response()->success($response);
        } catch (\Exception $e) {
            return throwException($e, 'logoutApi', $request->api_request_id);
        }
    }
}
