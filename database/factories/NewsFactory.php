<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'category' => fake()->randomElement(['Pendidikan', 'Beasiswa', 'Tips & Trik', 'Teknologi', 'Kampus']),
            'content' => fake()->paragraphs(5, true),
            'status' => 'published',
            'author_id' => User::factory(),
        ];
    }
}
