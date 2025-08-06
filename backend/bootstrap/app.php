<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Modules\Share\Http\Middleware\ResponseWrapper;
use App\Modules\Share\Http\Middleware\ForceJsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        apiPrefix: '',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend([
            ForceJsonResponse::class,
            ResponseWrapper::class,
            HandleCors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

    })
    ->create();
