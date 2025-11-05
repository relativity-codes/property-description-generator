<?php

// Increase PHP memory limit for local development HTTP requests to avoid memory exhaustion.
// For production, prefer changing the server php.ini or php-fpm config.
// `env()` helper isn't available here yet, so use getenv() with a sensible default.
$httpMemory = getenv('APP_HTTP_MEMORY_LIMIT') ?: '1G';
@ini_set('memory_limit', $httpMemory);

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$request = Request::capture();

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);