<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Institution;
use App\Models\NSSUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerProfileFactory extends Factory
{
    protected $model = \App\Models\VolunteerProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'institution_id' => Institution::factory(),
            'unit_id' => NSSUnit::factory(),
            'enrollment_number' => 'NSS-' . fake()->unique()->numberBetween(2024001, 2024999),
            'full_name' => fake()->name(),
            'date_of_birth' => fake()->dateTimeBetween('-22 years', '-18 years'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'pincode' => fake()->postcode(),
            'course' => fake()->randomElement(['BSc', 'BA', 'BCom', 'BTech']),
            'department' => fake()->randomElement(['Computer Science', 'Mathematics', 'Physics', 'Chemistry']),
            'year_of_study' => fake()->randomElement(['1', '2', '3']),
            'academic_year' => '2024-25',
            'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'status' => 'pending',
        ];
    }
}
