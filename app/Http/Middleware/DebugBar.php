<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebugBar
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('admin')->check()){
            \Debugbar::disable();
        }
        return $next($request);
    }
}
