<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class LicenseApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_license_requires_auth()
    {
        $response = $this->postJson('/api/licenses', []);
        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_license()
    {
        $user = User::factory()->create();
        // give permission via spatie
        if (class_exists(\Spatie\Permission\Models\Permission::class)) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'manage licenses']);
            $user->givePermissionTo('manage licenses');
        }
        $project = Project::factory()->create();

        $payload = [
            'project_id' => $project->id,
            'number' => 'ABC-123',
            'issuer' => 'Prefeitura',
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/licenses', $payload);
        $response->assertStatus(201)->assertJsonFragment(['number' => 'ABC-123']);
    }
}
