<?php

namespace App\Http\Middleware;

use App\Models\ApiRequest;
use App\Models\ApiRequestLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

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
            if ($route_name == 'api/login') {
                $request_data = $request->except(['password']);
            } else {
                $request_data = $request->all();
            }

            // Storing API Request Data
            $api_request_data = ApiRequest::create([
                'endpoint' => $route_name,
                'request_data' => $request_data,
                'user_id' => Auth::check() ? Auth::id() : null
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
            return throwException($e, $request->api_request_id);
        }
    }
}
