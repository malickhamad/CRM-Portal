<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/admin.php'));
            Route::middleware('web')->group(base_path('routes/user.php'));
            Route::middleware('web')->group(base_path('routes/frontend.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'subscription' => \App\Http\Middleware\CheckSubscription::class,
            'user.status' => \App\Http\Middleware\CheckUserStatus::class,
            'assessment' => \App\Http\Middleware\EnsureAssessmentInProgress::class,


        ]);

        $middleware->web([

            \App\Http\Middleware\CheckUserStatus::class, // Add this to the web group
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
