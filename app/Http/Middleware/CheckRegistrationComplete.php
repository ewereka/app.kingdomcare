<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRegistrationComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nextRoute = 'register.next';
        $allowedRoutes = array($nextRoute, 'user.update');

        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->registration_complete && !(in_array($request->route()->getName(), $allowedRoutes))) {
                return redirect()->route($nextRoute);
            }
        }
        return $next($request);
    }
}
