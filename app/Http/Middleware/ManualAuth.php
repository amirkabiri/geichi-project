<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;

class ManualAuth
{
    public function handle(Request $request, Closure $next)
    {
        if(app()->environment('production')) return $next($request);

        try {
            $guards = config('auth.guards');
            $providers = config('auth.providers');
            $guard = $request->header('Auth-Guard');

            if(isset($guards[$guard]) && $guards[$guard]['driver'] === 'token'){
                $provider = $providers[$guards[$guard]['provider']];
                $model = $provider['model'];

                $entity = $model::first();
                if(is_null($entity)) $entity = $model::factory()->create();

                $entity->api_token = generateApiToken();
                $entity->save();

                $request->headers->set('Authorization', 'Bearer ' . $entity->api_token);
            }
        } catch (Exception $exception) {}

        return $next($request);
    }
}
