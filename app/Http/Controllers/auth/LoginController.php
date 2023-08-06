<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginApi(LoginApiRequest $request)
    {
        try {
            $user = User::with('roles')->where('email', $request->email)->first();
            foreach ($user->roles as $role) {
                $role = $role->name;
            }
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $request->session()->put([
                    'logged_in_user' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'role' => $role
                ]);
                $response = ['token' => $token, 'role' => $role];
                $message = 'Logged in successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($response, $message);
            } else {
                $message = 'Credentials mismatched!';
                storeApiResponseData($request->api_request_id, $message, 401, false);
                return response()->error($message, 401);
            }
        } catch (\Exception $e) {
            return throwException($e, 'loginApi', $request->api_request_id);
        }
    }
}
