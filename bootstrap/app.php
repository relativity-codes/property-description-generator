<?php

use Illuminate\Foundation\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Here we will register the typical Laravel bindings for the HTTP kernel,
| console kernel, and exception handler. The framework will take care of
| resolving these from their concrete classes (App\Http\Kernel, etc.).
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

// Provide a fallback binding for the MaintenanceMode contract so middleware
// that checks maintenance mode can resolve an implementation early during
// the application's lifecycle. Laravel normally registers a manager via
// FoundationServiceProvider, but binding a simple FileBased implementation
// here prevents BindingResolutionExceptions in constrained environments.
$app->singleton(
    Illuminate\Contracts\Foundation\MaintenanceMode::class,
    function () {
        return new \Illuminate\Foundation\FileBasedMaintenanceMode();
    }
);

return $app;