<?php

namespace App\Http\Middleware;

use App\Models\ApiRequest;
use App\Models\ApiRequestLog;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class StoreApiRequestData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $route_name = $request->route()->uri();
            if ($route_name == 'api/auth/login') {
                $request_data = $request->except(['password']);
            } else {
                $request_data = $request->all();
            }
            
            // Checking for the user id to store in api request data
            if (Auth::check()) {
                $user_id = Auth::id();
            } else {
                if ($request->has('email')) {
                    $user_id = User::where('email', $request->email)->first('id');
                    if ($user_id) {
                        $user_id = $user_id->id;
                    } else {
                        return response()->error('The selected email is invalid.', 422);
                    }
                } else {
                    $user_id = null;
                }
            }

            // Storing API Request Data
            $api_request_data = ApiRequest::create([
                'endpoint' => $route_name,
                'request_data' => $request_data,
                'user_id' => $user_id
            ]);
            $request['api_request_id'] = $api_request_data->id;
            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());

            // Storing API Request Log Data
            ApiRequestLog::create([
                'ip_address' => $request->getClientIp(),
                'browser' => $agent->browser(),
                'os' => $agent->platform(),
                'device_type' => $agent->device(),
                'agent' => $request->userAgent(),
                'api_request_id' => $api_request_data->id
            ]);
            return $next($request);
        } catch (\Exception $e) {
            return throwException($e, 'StoreApiRequestData middleware', $request->api_request_id);
        }
    }
}
