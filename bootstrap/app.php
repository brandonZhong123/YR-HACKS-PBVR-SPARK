<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TutorMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'super_admin' => SuperAdminMiddleware::class,
            'admin' => AdminMiddleware::class,
            'tutor' => TutorMiddleware::class,
            'student' => StudentMiddleware::class,
            'tutor_admin' => [
                TutorMiddleware::class,
                AdminMiddleware::class,
            ],
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
