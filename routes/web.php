<?php

use App\Http\Controllers\DocsController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocsController::class, 'view']);
