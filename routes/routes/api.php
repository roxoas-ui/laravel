<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseController;

Route::prefix('v1')->group(function () {
    Route::apiResource('licenses', LicenseController::class);
});
