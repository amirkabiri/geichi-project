<?php

use App\Http\Controllers\V1\ApplyController;
use App\Http\Controllers\V1\BarberServiceController;
use App\Http\Controllers\V1\ReservationController;
use App\Http\Controllers\V1\ShopController;
use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\PlanController;
use App\Http\Controllers\V1\ShopServiceController;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Users\AuthController as UsersAuthController;
use App\Http\Controllers\V1\Barbers\AuthController as BarbersAuthController;
use App\Http\Controllers\V1\BarberController;
use App\Http\Controllers\V1\LatestVerifyCodeController;

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

Route::middleware('auth:barber,user')->group(function(){
    Route::apiResource('plans', PlanController::class)->only(['index', 'show']);
    Route::apiResource('shops', ShopController::class);
    Route::apiResource('shops.barbers', BarberController::class)->only(['index', 'show']);
    Route::apiResource('shops.barbers.services', BarberServiceController::class)->only(['index', 'show']);
    Route::apiResource('shops.barbers.services.reservations', ReservationController::class);//->only(['index', 'show']);
    Route::apiResource('shops.comments', CommentController::class);
    Route::apiResource('shops.applies', ApplyController::class);
    Route::apiResource('shops.services', ShopServiceController::class);
    Route::prefix('/shops/{shop}')->group(function(){
        Route::post('/services/{service}/{action}', [ShopServiceController::class, 'serve'])->where('action', 'attach|detach');
        Route::post('/applies/{apply}/{status}', [ApplyController::class, 'status'])->where('status', 'accept|deny');
        Route::prefix('/barbers/{barber}')->group(function(){
            Route::delete('/fire', [BarberController::class, 'fire']);
        });
    });
});

Route::get("latest-verify-code", [LatestVerifyCodeController::class, 'index'])->name('latest-verify-code');

