<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\License;
use App\Models\Project;

class LicenseFactory extends Factory
{
    protected $model = License::class;

    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'number' => $this->faker->unique()->bothify('LIC-###'),
            'issuer' => $this->faker->company,
            'issued_at' => now(),
            'expires_at' => now()->addYear(),
        ];
    }
}
