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
        then: function () {
            // Channels route (broadcast)
            if (file_exists(__DIR__ . '/../routes/channels.php')) {
                require __DIR__ . '/../routes/channels.php';
            }
        },
    )

    ->withMiddleware(function (Middleware $middleware) {

        // === Spatie Permissions ===
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        // === Custom RASP Middleware ===
        $middleware->append(\App\Http\Middleware\BlockSQLInjection::class);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
