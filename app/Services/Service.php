<?php

namespace App\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

abstract class Service
{
    use AuthorizesRequests {
        authorize as protected baseAuthorize;
    }

    protected function authorize($ability, $arguments = []): Service
    {
        $guard = currentGuard();
        if(!is_null($guard)) Auth::shouldUse($guard);

        $this->baseAuthorize($ability, $arguments);

        return $this;
    }

    protected function validate(...$args): Service
    {
        Validator::make(...$args)->validate();

        return $this;
    }

    protected function findOrFail($model, $entity){
        if(is_object($entity)) return $entity;

        return $model::findOrFail($entity);
    }
}
