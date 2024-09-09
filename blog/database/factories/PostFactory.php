<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'name' => fake() o 'title' => $this->faker es lo mismo
            'title' => $this->faker->sentence(),
            'content' => fake()->text(500),
            'category' => fake()->word(1),
            'published_at' => $this->faker->dateTime(),
            'slug' => fake()->slug(),
        ];
    }
}
