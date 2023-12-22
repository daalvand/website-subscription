<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('websites/{website}')
    ->as('websites.')
    ->group(function () {
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    });
