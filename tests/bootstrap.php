<?php

require __DIR__ . '/../vendor/autoload.php';

// Set environment variables used by phpunit/phpunit and the app before bootstrapping
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=:memory:');
putenv('AUTH_DEFAULT_GUARD=sanctum');

// Bootstrap the Laravel application
$app = require __DIR__ . '/../bootstrap/app.php';

// Boot the application (like vendor/autoload would normally do)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// After the app is bootstrapped we can safely call config() and app() helpers
// Ensure sanctum guard is present and used in tests so Spatie recognizes it
config(['auth.guards.sanctum' => ['driver' => 'sanctum', 'provider' => 'users']]);
config(['auth.defaults.guard' => env('AUTH_DEFAULT_GUARD', 'sanctum')]);

// Clear spatie permission cache to avoid stale guard lists
if (class_exists(Spatie\Permission\PermissionRegistrar::class)) {
    app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
}
