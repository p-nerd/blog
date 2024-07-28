<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(8, false),
            'excerpt' => '<p>'.implode('</p><p>', fake()->paragraphs(2)).'</p>',
            'body' => '<p>'.implode('</p><p>', fake()->paragraphs(6)).'</p>',
            'published_at' => fake()->date('2020-01-01', now()),
            'slug' => fake()->unique()->slug(),
            'thumbnail' => fake()->imageUrl(),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
