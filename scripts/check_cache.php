<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'cache.default=' . config('cache.default') . PHP_EOL;
$store = \Illuminate\Support\Facades\Cache::getFacadeRoot()->getStore();
echo get_class($store) . PHP_EOL;
