<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+30 days');

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'category' => fake()->randomElement([
                'Cleanliness Drive', 'Tree Plantation', 'Blood Donation',
                'Health Awareness', 'Digital Literacy', 'Educational Outreach',
            ]),
            'venue' => fake()->address(),
            'start_date' => $startDate,
            'end_date' => (clone $startDate)->modify('+1 day'),
            'registration_deadline' => (clone $startDate)->modify('-1 day'),
            'capacity' => fake()->numberBetween(20, 200),
            'eligibility_conditions' => 'Open to all NSS volunteers',
            'visibility' => 'public',
            'status' => 'published',
            'registration_status' => 'open',
        ];
    }
}
