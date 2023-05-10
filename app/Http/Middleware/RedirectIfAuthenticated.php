<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'bd604be227ff962aa698fb753290751a' :
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('bd604be227ff962aa698fb753290751a.dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('user.dashboard');
                }
                break;
        }
        return $next($request);
    }
}
