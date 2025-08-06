<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Share\Http\Middleware\CheckMagicLink;
use App\Modules\Auth\Http\Controllers\UserController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);

    Route::middleware(CheckMagicLink::class)->group(function () {
        Route::post('/deactivate', [UserController::class, 'deactivate']);
        Route::post('/regenerate', [UserController::class, 'regenerate']);
        Route::get('/me', [UserController::class, 'me']);
    });
});
