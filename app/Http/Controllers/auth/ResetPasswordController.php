<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function resetPasswordApi(ResetPasswordRequest $request)
    {
        try {
            $record = DB::table('password_reset_tokens')->where('token', $request->token)
                ->where('email', $request->email)->latest();
            if ($record) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->password);
                $user->save();
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();
                $response = ['message' => 'Password has been reset!'];
                storeApiResponseData($request->api_request_id, $response, false);
                return response()->success($response);
            }
            $response = ['message' => 'Record not found for resetting password!'];
            storeApiResponseData($request->api_request_id, $response, true);
            return response()->error('Record not found for resetting password!', 404);
        } catch (\Exception $e) {
            return throwException($e, 'resetPasswordApi', $request->api_request_id);
        }
    }
}
