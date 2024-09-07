<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tweet::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'username' => $this->faker->userName,
            'content' => $this->faker->sentence,
            'created_at' => now(),
        ];
    }
}
