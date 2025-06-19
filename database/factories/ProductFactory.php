<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(50, 1000),
            'in_stock' => $this->faker->boolean(80), 
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        
        ];
    }
}
