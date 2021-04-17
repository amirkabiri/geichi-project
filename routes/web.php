<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return \Illuminate\Support\Facades\App::version();
    $user = new User();

//    return User::factory()->create();

    return $user->where('first_name', 'Urban')->get();

    return (int)App::version();
    return version_compare(\Illuminate\Support\Facades\App::version(), 8.35);

    $user = User::first();
    if(!$user){
        $user = User::factory()->create();
    }

    $token = $user->generateApiToken();

    return [
        $user,
        $token
    ];
});
