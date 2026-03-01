<?php

use App\Http\Middleware\ColocationRole;
use App\Http\Middleware\EnsureColocationIsActive;
use App\Http\Middleware\IsBannedOrDeactive;
use App\Http\Middleware\Role;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'colocation' => ColocationRole::class,
            "role" => Role::class,
            "isBannedOrDeactive" => IsBannedOrDeactive::class,
            'ensureColocationIsActive' => EnsureColocationIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
