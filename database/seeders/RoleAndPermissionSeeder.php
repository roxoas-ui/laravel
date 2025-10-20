<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
    // Cria role admin se não existir (guard 'sanctum')
    $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'sanctum']);

        // Opcional: você pode criar permissões padrão aqui
        // $perm = Permission::firstOrCreate(['name' => 'manage users']);
        // $adminRole->givePermissionTo($perm);

        // Atribui ao usuário admin seed
        $email = env('ADMIN_EMAIL', 'admin@local.test');
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->assignRole($adminRole);
            $this->command->info("Role 'admin' atribuída ao usuário: {$email}");
        } else {
            $this->command->warn("Usuário {$email} não encontrado. Role não atribuída.");
        }
    }
}
