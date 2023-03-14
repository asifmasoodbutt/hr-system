<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use App\Models\ApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

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
                $response_data = ['errors' => false, 'data' => []];
                ApiRequest::where('id', $request->api_request_id)->update(['response_data' => $response_data]);
                return response()->success($response);
            } else {
                $response = ["message" => "Password mismatch"];
                return response()->error('Credentials mismatched!', 401);
            }
        } catch (\Exception $e) {
            return throwException($e, $request->api_request_id);
        }
    }
}
