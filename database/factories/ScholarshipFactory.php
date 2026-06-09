<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scholarship>
 */
class ScholarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        $start = fake()->dateTimeBetween('now', '+1 month');
        $end = fake()->dateTimeBetween('+2 months', '+3 months');

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'organizer' => fake()->company(),
            'start_date' => $start,
            'end_date' => $end,
            'location' => fake()->city(),
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'benefits' => fake()->paragraphs(2, true),
            'registration_link' => fake()->url(),
            'status' => 'published',
            'created_by' => User::factory(),
        ];
    }
}
