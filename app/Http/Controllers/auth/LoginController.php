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
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $request->session()->put([
                    'logged_in_user' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name
                ]);
                $response = ['token' => $token];
                storeApiResponseData($request->api_request_id, ['user_data' => $user], 200, true);
                return response()->success($response);
            } else {
                storeApiResponseData($request->api_request_id, 'Credentials mismatched!', 401, false);
                return response()->error('Credentials mismatched!', 401);
            }
        } catch (\Exception $e) {
            return throwException($e, 'loginApi', $request->api_request_id);
        }
    }
}
