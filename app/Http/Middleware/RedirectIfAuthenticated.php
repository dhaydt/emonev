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
        // if (Auth::guard($guard)->check()) {
        //     if (Auth::guard('opd')->check()) {
        //         return redirect('/opd');
        //     }else{
        //         return redirect('/home');    
        //     }
        // }
        if (Auth::guard('opd')->check()) {
            return redirect('/opd');
        }elseif(Auth::guard('web')->check()){
            return redirect('/home');    
        }
        return $next($request);
    }
}
