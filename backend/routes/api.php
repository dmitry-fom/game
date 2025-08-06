<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/up', function() {
    return view('up');
});