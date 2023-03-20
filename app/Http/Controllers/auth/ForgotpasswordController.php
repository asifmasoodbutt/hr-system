<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\SendResetLinkMail;
use App\Models\ApiRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotpasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try {
            $token = Str::random(120);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);
            $data = [
                'token' => $token,
                'email' => $request->email
            ];
            Mail::to($request->email)->send(new SendResetLinkMail($data));
            $response = ['message' => 'Reset password email has been sent to your email!'];
            storeApiResponseData($request->api_request_id, $response, true);
            return response()->success($response);
        } catch (\Exception $e) {
            return throwException($e, 'sendResetLinkEmail', $request->api_request_id);
        }
    }
}
