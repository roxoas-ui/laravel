<?php

require __DIR__ . '/../vendor/autoload.php';

// Ensure sanctum guard is present and used in tests so Spatie recognizes it
config(['auth.guards.sanctum' => ['driver' => 'sanctum', 'provider' => 'users']]);
config(['auth.defaults.guard' => 'sanctum']);

// Clear spatie permission cache to avoid stale guard lists
if (class_exists(Spatie\Permission\PermissionRegistrar::class)) {
    app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
}

// Bootstrap the Laravel application
$app = require __DIR__ . '/../bootstrap/app.php';

// Boot the application (like vendor/autoload would normally do)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
