<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin_auth' => \App\Http\Middleware\User\AdminAuth::class,
            'check_role' => \App\Http\Middleware\User\CheckRole::class,
            'check_period' => \App\Http\Middleware\Game\CheckPeriod::class,
            'ensure_game_selected' => \App\Http\Middleware\Game\EnsureGameIsSelected::class,
            'impersonate' => \App\Http\Middleware\User\Impersonate::class,
            'gamemaster_auth' => \App\Http\Middleware\User\GamemasterAuth::class,
            'localization' => \App\Http\Middleware\Localization::class,
            'role_dashboard' => \App\Http\Middleware\User\RedirectToRoleDashboard::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
