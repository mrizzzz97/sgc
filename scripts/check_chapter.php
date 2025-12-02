<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Chapter;

$c = Chapter::with('module')->find(6);
if ($c) {
    echo json_encode(['id' => $c->id, 'title' => $c->title, 'module_id' => $c->module_id], JSON_UNESCAPED_UNICODE) . PHP_EOL;
} else {
    echo "null" . PHP_EOL;
}
