<?php

use App\Http\Controllers\V1\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Users\AuthController as UsersAuthController;
use App\Http\Controllers\V1\Barbers\AuthController as BarbersAuthController;

if(! function_exists('AuthRoutes')){
    function AuthRoutes($controller){
        Route::prefix('auth')->name('auth.')->group(function() use ($controller) {
            Route::post('/request', [$controller, 'request'])->name('request');
            Route::post('/verify', [$controller, 'verify'])->name('verify');
        });
    }
}

Route::prefix('users')->name('users.')->group(function(){
    AuthRoutes(UsersAuthController::class);
});

Route::prefix('barbers')->name('barbers.')->group(function(){
    AuthRoutes(BarbersAuthController::class);
});

Route::apiResource('plans', PlanController::class)->only(['index', 'show']);
