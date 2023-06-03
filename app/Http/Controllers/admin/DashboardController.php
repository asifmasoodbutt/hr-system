<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('main.dashboard');
    }

    public function forbidden()
    {
        return view('auth.forbidden');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('id', Auth::id())->first();
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = $request->password;
                $user->save();
                $response = ['message' => 'Your password has been changed!'];
                storeApiResponseData($request->api_request_id, $response, 200, true);
                return response()->success($response);
            } else {
                storeApiResponseData($request->api_request_id, 'Current password is incorrect!', 422, false);
                return response()->error('Current password is incorrect!', 422);
            }
        } catch (\Exception $e) {
            return throwException($e, 'changePassword', $request->api_request_id);
        }
    }
}
