<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DistinguishAuth
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
        if(Auth::guard('admin')->check()){
            return redirect(route('admin.dashboard'));
        }
        elseif(Auth::guard()->check()){
            return redirect(route('user.dashboard'));
        }
        return $next($request);
    }
}
