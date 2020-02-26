<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roles = (is_string($roles) && strlen($roles) > 0) ? [$roles] : $roles;
            $roles = (is_array($roles) && sizeof($roles) > 0) ? $roles : null;
            if ($roles !== null && $user->hasAnyRole($roles)) {
                return $next($request);
            }
        }
        abort(403, 'You shall not pass!');
    }
}
