<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\guest;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\StatusAndRoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->use([
        //     MasyarakatMiddleware::class,
        //     AdminMiddleware::class,
        // ]);
        // $middleware->append(StatusAndRoleMiddleware::class);
        // $middleware->append(PublicAccess::class);
        $middleware->alias([
            'isAdmin' => isAdmin::class,
            'guest' => guest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
