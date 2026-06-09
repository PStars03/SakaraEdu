<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bootcamp>
 */
class BootcampFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3) . ' Bootcamp';
        $start = fake()->dateTimeBetween('now', '+1 month');
        $end = fake()->dateTimeBetween('+2 months', '+3 months');
        $isPaid = fake()->boolean(60);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'organizer' => fake()->company(),
            'start_date' => $start,
            'end_date' => $end,
            'location' => fake()->randomElement(['Online', 'Offline - Jakarta', 'Hybrid']),
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'curriculum' => fake()->paragraphs(2, true),
            'registration_link' => fake()->url(),
            'status' => 'published',
            'is_paid' => $isPaid,
            'price' => $isPaid ? fake()->randomElement([150000, 500000, 1000000, 2500000]) : null,
            'created_by' => User::factory(),
        ];
    }
}
