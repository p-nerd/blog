<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'body' => fake()->paragraph(),
        ];
    }
}
