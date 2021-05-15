<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Request $request) {
    return dd(auth()->id());
    $shop = \App\Models\Shop::with('owner')->find(1);
    $owner = $shop->owner;
    $owner = User::find(1);
    return $owner->isOwnerOfShop(\App\Models\Shop::find(1)) ?? false;
    return \App\Models\Barber::find(11);
    return $shop;
});
