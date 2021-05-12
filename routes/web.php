<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Request $request) {
    $comment = Comment::find(1);
    return get_class($comment->sender);
    return last(explode('\\', $comment->sender_type));
    return dd(auth('barber')->user());
    return dd(currentGuard());
    return auth()->user();

    return \App\Models\Comment::find(1)->sender;
    return User::find(21)->comments;


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
