<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Plan;
use App\Policies\PlanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Plan::class => PlanPolicy::class,
        Comment::class => CommentPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
