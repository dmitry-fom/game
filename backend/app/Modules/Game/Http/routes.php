<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Share\Http\Middleware\CheckMagicLink;
use App\Modules\Game\Http\Controllers\GameController;

Route::middleware([CheckMagicLink::class])
    ->prefix('game')
    ->group(function () {
        Route::get('/play', [GameController::class, 'play']);
        Route::get('/history', [GameController::class, 'history']);
    });