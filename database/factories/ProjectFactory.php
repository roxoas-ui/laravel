<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Client;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
        ];
    }
}
