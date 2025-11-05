<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cfg = config('openai');
if (empty($cfg) || empty($cfg['api_key'])) {
    echo "ERROR: openai config or api_key missing\n";
    exit(2);
}

$url = $cfg['url'];
$model = $cfg['model'];
$apiKey = $cfg['api_key'];

$payload = json_encode([
    'model' => $model,
    'messages' => [
        ['role' => 'system', 'content' => 'System test: return a short diagnostic.'],
        ['role' => 'user', 'content' => 'Say OK.'],
    ],
    'max_tokens' => 10,
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$resp = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);

echo "HTTP_STATUS:" . $code . "\n";
if ($err) {
    echo "CURL_ERROR:" . $err . "\n";
}

// Print a trimmed response to avoid huge output
if ($resp) {
    $trim = substr($resp, 0, 2000);
    echo "RESPONSE_BODY_TRUNCATED:\n" . $trim . "\n";
} else {
    echo "RESPONSE_BODY_EMPTY\n";
}

curl_close($ch);
