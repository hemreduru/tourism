<?php

use App\Http\Middleware\SetLocale;
use App\Providers\LanguageServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        LanguageServiceProvider::class,
        App\Providers\ToastrServiceProvider::class,
        App\Providers\ViewServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware) {
        // Register the SetLocale middleware
        $middleware->web(append: [
            SetLocale::class,
            \App\Http\Middleware\ToastrMiddleware::class,
        ]);

        // Register aliases for middleware
        $middleware->alias([
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
