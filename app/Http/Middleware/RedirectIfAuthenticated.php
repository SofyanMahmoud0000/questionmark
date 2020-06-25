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
    public function handle($request, Closure $next, $guard1 = null , $guard2 = null)
    {

        if(!Auth::guard($guard1)->check() && !Auth::guard($guard2)->check()){
            return $next($request);
        }
        elseif(auth()->guard($guard1)->check())
            return redirect('home');
        else
            return redirect("data");
    }
}
