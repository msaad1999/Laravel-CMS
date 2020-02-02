<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Monitor
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
        if(Auth::check()){

            if (Auth::user()->isAdmin() || Auth::user()->isModerator() || Auth::user()->isMonitor()){

                return $next($request);
            }
        }
        return redirect(404);
    }
}
