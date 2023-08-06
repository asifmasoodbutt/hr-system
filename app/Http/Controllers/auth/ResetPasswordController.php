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
                $user->password = $request->password;
                $user->save();
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();
                $message = 'Your password has been reset successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, false);
                return response()->success([], $message);
            }
            $message = 'Record not found for resetting password!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 404, true);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'resetPasswordApi', $request->api_request_id);
        }
    }
}
