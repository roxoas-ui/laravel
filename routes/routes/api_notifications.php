<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\IcalController;

Route::prefix('v1')->group(function () {
    Route::get('export/ical', [IcalController::class, 'export']);
    Route::get('reports/licenses/pdf', [ReportController::class, 'generalStatusPdf']);
    Route::get('reports/licenses/excel', [ReportController::class, 'exportLicensesExcel']);
});
