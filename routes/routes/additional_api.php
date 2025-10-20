<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AvcbController;
use App\Http\Controllers\ConditionalController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('avcbs', AvcbController::class);
    Route::apiResource('conditionals', ConditionalController::class);
    Route::post('attachments', [AttachmentController::class, 'store']);
    Route::apiResource('calendar-events', CalendarEventController::class);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
