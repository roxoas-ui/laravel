<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AclAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_non_admin_cannot_create_role()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/admin/roles', ['name' => 'inspector']);
        $response->assertStatus(403);
    }

    public function test_admin_can_create_role_and_assign_to_user()
    {
        $admin = User::factory()->create();
        // create admin role and assign to user via spatie API
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $guard = 'sanctum';
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard]);
            $admin->assignRole($role);
            // Refresh Spatie cached permissions/roles to avoid stale guard lists
            app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        }

        $user = User::factory()->create();

    $response = $this->actingAs($admin, 'sanctum')->postJson('/api/admin/roles', ['name' => 'inspector']);
        $response->assertStatus(201)->assertJsonFragment(['name' => 'inspector']);

    // ensure cache is cleared after creating the role via API
    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // role assignment verified via API (no local debug needed)

        // assign role to user
        $assign = $this->actingAs($admin, 'sanctum')->postJson('/api/admin/users/' . $user->id . '/roles', ['role' => 'inspector']);
        $assign->assertStatus(200)->assertJsonFragment(['name' => 'inspector']);
    }
}
