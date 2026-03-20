<?php

require __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require __DIR__ . '/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Run Temporal Worker
App\Temporal\Worker::run();