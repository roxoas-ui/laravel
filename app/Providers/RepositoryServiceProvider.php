<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LicenseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LicenseRepository::class, function ($app) {
            return new LicenseRepository();
        });
    }

    public function boot()
    {
    }
}
