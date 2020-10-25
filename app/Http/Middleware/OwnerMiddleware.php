<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
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
        if (Auth::check()) {
            if (Auth::user()->is_owner == true)
                return $next($request);
            else {
                Auth::logout();
                return redirect(config('constants.ADMIN_PREFIX').'/login');
            }
        } else {
            return redirect(config('constants.ADMIN_PREFIX').'/login');
        }
    }
}
