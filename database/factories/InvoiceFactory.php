<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'inv_number' => 'INV#' . fake()->randomNumber(5),
            'total_amount' => fake()->randomNumber(2),
            'notes' => fake()->sentence(10),
            'status' => fake()->randomElement(['darft', 'published'])
        ];
    }
}
