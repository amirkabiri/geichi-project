<?php

use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;

Route::get('/', [DocsController::class, 'view']);

Route::prefix('/admin/login')->name('admin.login')->middleware('guest.else:admin,admin.dashboard')->group(function(){
    Route::get('/', [AdminLoginController::class, 'view']);
    Route::post('/', [AdminLoginController::class, 'handle'])->name('.handle');
});

Route::get('/erd', function(){
    if(!app()->environment('local')) abort(404);

    $path = storage_path('app/erd.png');
    \Illuminate\Support\Facades\Artisan::call('generate:erd', ['filename' => $path]);

    return response()->file($path);
});
