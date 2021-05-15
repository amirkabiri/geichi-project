<?php

use App\Http\Controllers\V1\BarberShopController;
use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\PlanController;
use App\Models\Barber;
use App\Models\User;
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

Route::middleware('auth:barber,user')->group(function(){
    Route::apiResource('plans', PlanController::class)->only(['index', 'show']);
    Route::apiResource('shops', BarberShopController::class);
    Route::apiResource('shops.comments', CommentController::class);
});

Route::get("latest-verify-code", function(){
    $latest_barber = Barber::latest('updated_at')->first();
    $latest_user = User::latest('updated_at')->first();
    $objects = array_filter([$latest_user, $latest_barber], function($obj){
        return !is_null($obj);
    });
    usort($objects, function($a, $b){
        return $b->updated_at->timestamp - $a->updated_at->timestamp;
    });
    return $objects[0]->login_code;
});









