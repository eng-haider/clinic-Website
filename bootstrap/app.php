<?php

use App\Http\Controllers\CasePhotoProxyController;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // Stateless image proxy: registered outside the web group so it never
        // starts a DB session or sets cookies per <img> request.
        then: function () {
            Route::get('/case-photo/{filename}', [CasePhotoProxyController::class, 'show'])
                ->where('filename', '[A-Za-z0-9_\-.]+')
                ->name('case.photo.proxy');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
