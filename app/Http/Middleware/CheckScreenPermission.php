<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckScreenPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        // Get the authenticated user
        $user_id = User::find(session()->get('logged_in_user'));
        // Check if the user has the required permission for the route
        if (!$user_id->hasPermission($permission)) {
            // Redirect the user to the Forbidden page
            return redirect()->route('forbidden');
        }
        // Continue to the next middleware or the route's controller
        return $next($request);
    }
}
