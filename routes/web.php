<?php

use App\Http\Controllers\DocsController;
use App\Models\Barber;
use App\Models\Comment;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

Route::get('/', [DocsController::class, 'view']);

Route::get('/erd', function(){
    \Illuminate\Support\Facades\Artisan::call('generate:erd', ['filename' => storage_path('app/erd.png')]);
    return response()->file(storage_path('app/erd.png'));
    return response()->file(public_path('graph.png'));


    return;
    $comment = Comment::factory()->create();

//    User::destroy($comment->sender_id);

    return [
        'sender' => $comment->sender,
        'comments' => $comment->sender->comments
    ];



    $shop = Shop::factory()->create();
    $barber = Barber::factory()->create(['shop_id' => $shop->id]);
    $shop->owner()->delete();

    return [
        'shop' => Shop::find($shop->id),
        'owner' => User::find($shop->owner_id),
        'barber' => Barber::find($barber->id)
    ];
});
