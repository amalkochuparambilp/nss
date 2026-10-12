<?php

namespace Database\Factories;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

class NSSUnitFactory extends Factory
{
    protected $model = \App\Models\NSSUnit::class;

    public function definition(): array
    {
        return [
            'institution_id' => Institution::factory(),
            'name' => 'NSS Unit ' . fake()->numberBetween(1, 10),
            'code' => 'NSS-' . fake()->unique()->numerify('###'),
            'description' => fake()->sentence(),
            'capacity' => fake()->numberBetween(50, 200),
            'is_active' => true,
        ];
    }
}
