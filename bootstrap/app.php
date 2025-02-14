<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin_auth' => \App\Http\Middleware\AdminAuth::class,
            'gamemaster_auth' => \App\Http\Middleware\GamemasterAuth::class,
            'check_role' => \App\Http\Middleware\CheckRole::class,
            'check_period' => \App\Http\Middleware\CheckPeriod::class,
            'impersonate' => \App\Http\Middleware\Impersonate::class,
            'localization' => \App\Http\Middleware\Localization::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
