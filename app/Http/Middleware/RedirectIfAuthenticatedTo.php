<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedTo
{
    public function handle(Request $request, Closure $next, $guard, $route)
    {
        if(Auth::guard($guard)->check()){
            return redirect()->route($route);
        }

        return $next($request);
    }
}
