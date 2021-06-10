<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Telescope\Telescope;

class DarkMode
{
    public function handle(Request $request, Closure $next)
    {
        if($request->has('dark')){
            session(['dark' => $request->dark === 'on']);
        }

        if(session('dark')){
//            dd(session('dark'));
//            exit;
            Telescope::night();
        }

        return $next($request);
    }
}
