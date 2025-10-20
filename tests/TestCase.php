<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\PermissionRegistrar;

use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure tests use the API guard and clear Spatie cache to avoid guard mismatches
        // Ensure a sanctum guard is declared in config so Spatie recognizes it
        config(['auth.guards.sanctum' => ['driver' => 'sanctum', 'provider' => 'users']]);
        config(['auth.defaults.guard' => 'sanctum']);
        // Clear cached permissions & roles in case previous runs cached them
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Re-run migrations/seeds if needed (kept minimal to avoid long test runs)
        // Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\PermissionsSeeder']);
    }
}
