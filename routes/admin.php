<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/logout', 'LogoutController@handle')->name('logout');

Route::resource('/admins', 'AdminsController');
Route::resource('/shops', 'ShopsController');
