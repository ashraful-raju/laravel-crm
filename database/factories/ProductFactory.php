<?php

namespace Database\Factories;

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
            'name' => fake()->name(),
            'unit_price' => fake()->randomNumber(3),
            'brand' => fake()->company(),
            'description' => fake()->sentence(20),
            'pre_quantity' => fake()->randomNumber(2),
            'available' => fake()->randomNumber(2),
            'image' => fake()->imageUrl(),
        ];
    }
}
