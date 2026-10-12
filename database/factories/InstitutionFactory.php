<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionFactory extends Factory
{
    protected $model = \App\Models\Institution::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' College',
            'code' => strtoupper(fake()->unique()->bothify('???####')),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'pincode' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'website' => fake()->url(),
            'is_active' => true,
        ];
    }
}
