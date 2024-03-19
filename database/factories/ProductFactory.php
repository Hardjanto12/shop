<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Illuminate\Support\Str;

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
            'item' => fake()->unique->numberBetween(20, 50000),
            'product_serial_number' => 'ML' . '-' . sprintf("%03d", fake()->unique->numberBetween(1, 100)),
            'description' => fake()->sentence,
            'price' => fake()->randomFloat(2, 10, 200),
            'category_id' => fake()->numberBetween(1, 5) // Random price between 10 and 100
        ];
    }
}
