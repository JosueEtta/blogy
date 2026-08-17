<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
            // Creates a User automatically if user_id isn't provided
            'user_id' => User::factory(), 
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(1, true),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
