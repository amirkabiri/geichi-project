<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NormalizePhone
{
    public function handle(Request $request, Closure $next, $field='phone')
    {
        if($request->has($field) && is_string($request->get($field))){
            $request->merge([
                $field => normalizePhone($request->get($field))
            ]);
        }

        return $next($request);
    }
}
