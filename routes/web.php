<?php

use App\Http\Controllers\DocsController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [DocsController::class, 'view']);

Route::get('/test', function(){
    $barber = \App\Models\Barber::find(1);
//    $barber->services()->attach($barber->shop->services()->pluck('id'));
//    return $barber;
    return $barber->with('services')->first();
    return $barber->shop->services->save(\App\Models\Service::factory()->make());
});
