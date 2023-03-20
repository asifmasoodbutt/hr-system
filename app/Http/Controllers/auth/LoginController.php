<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use App\Models\ApiRequest;
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
                $response = ['token' => $token];
                storeApiResponseData($request->api_request_id, [], 200, true);
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
