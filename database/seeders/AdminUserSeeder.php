<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an initial admin user for development
        $email = env('DEV_ADMIN_EMAIL', 'admin@local.test');
        $password = env('DEV_ADMIN_PASSWORD', 'SenhaTemporaria123!');

        $user = User::firstOrNew(['email' => $email]);
        $user->name = 'Administrador';
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->email_verified_at = now();
        $user->save();

        // Output info to the console when running seeder
        $this->command->info("Admin user ensured: {$email} / {$password}");
    }
}
