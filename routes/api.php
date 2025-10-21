<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\AttachmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class)->only(['index','store']);
    Route::apiResource('licenses', LicenseController::class);
    Route::post('attachments', [AttachmentController::class, 'store']);

    // Admin ACL management
    Route::middleware('role:admin,sanctum')->prefix('admin')->group(function () {
        Route::get('roles', [\App\Http\Controllers\Admin\RoleController::class, 'index']);
        Route::post('roles', [\App\Http\Controllers\Admin\RoleController::class, 'store']);
            Route::delete('roles/{roleName}', function ($roleName) {
                $role = \Spatie\Permission\Models\Role::where('name', $roleName)->firstOrFail();
                $role->delete();
                return response()->noContent();
            });

            Route::get('roles/{roleName}/users', function ($roleName) {
                $role = \Spatie\Permission\Models\Role::where('name', $roleName)->firstOrFail();
                $ids = \DB::table('model_has_roles')->where('role_id', $role->id)->pluck('model_id');
                return \App\Models\User::whereIn('id', $ids)->get();
            });
    Route::get('attachments/{attachment}/download', [\App\Http\Controllers\AttachmentController::class, 'download'])->name('attachments.download');
    Route::get('attachments/{attachment}/signed', [\App\Http\Controllers\AttachmentController::class, 'signedDownload'])->name('attachments.signed')->middleware('signed');

        Route::get('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'index']);
        Route::post('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'store']);

        Route::post('users/{user}/roles', function (\Illuminate\Http\Request $request, \App\Models\User $user) {
            $roleName = $request->input('role');
            // Prefer explicit lookup using the API guard (sanctum) to avoid Spatie guard mismatch
            $role = \Spatie\Permission\Models\Role::where(['name' => $roleName, 'guard_name' => 'sanctum'])->first();
            if (! $role) {
                return response()->json(['message' => 'Role not found for guard sanctum'], 404);
            }
            try {
                $user->assignRole($role);
                return response()->json($user->roles);
            } catch (\Throwable $e) {
                \Log::error('Assign role failed', ['role' => $roleName, 'role_obj' => $role, 'exception' => $e]);
                return response()->json(['message' => 'assign_role_error', 'error' => $e->getMessage()], 500);
            }
        });

        Route::post('roles/{roleName}/permissions', function (\Illuminate\Http\Request $request, $roleName) {
            $role = \Spatie\Permission\Models\Role::where(['name' => $roleName, 'guard_name' => 'sanctum'])->firstOrFail();
            $permission = $request->input('permission');
            $role->givePermissionTo($permission);
            return response()->json($role->permissions);
        });
    });
});
