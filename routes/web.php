<?php

use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocsController::class, 'view']);

Route::get('/erd', function(){
    if(!app()->environment('local')) abort(404);

    $path = storage_path('app/erd.png');
    \Illuminate\Support\Facades\Artisan::call('generate:erd', ['filename' => $path]);

    return response()->file($path);
});
