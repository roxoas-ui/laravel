<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'manager', 'user'];
        $guard = 'sanctum';
        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r, 'guard_name' => $guard]);
        }

        $perms = ['view licenses', 'manage licenses', 'manage users'];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => $guard]);
        }

        $admin = User::where('email', env('ADMIN_EMAIL', 'admin@local.test'))->first();
        if ($admin) {
            $admin->assignRole('admin');
            $admin->givePermissionTo(Permission::all());
            $this->command->info('Admin permissions assigned.');
        } else {
            $this->command->warn('Admin user not found. Run AdminUserSeeder first.');
        }
    }
}
