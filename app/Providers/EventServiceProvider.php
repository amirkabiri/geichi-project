<?php

namespace App\Providers;

use App\Events\CommentSenderDeleted;
use App\Listeners\ClearCommentsSender;
use App\Models\Barber;
use App\Models\User;
use App\Observers\BarberObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CommentSenderDeleted::class => [
            ClearCommentsSender::class,
        ],
    ];

    public function boot()
    {
        User::observe(UserObserver::class);
        Barber::observe(BarberObserver::class);
    }
}
