<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductType;
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
            'product_type_id' => ProductType::factory(),
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1500, 25000),
            'stock' => fake()->numberBetween(5, 50),
            'image' => fake()->imageUrl(640, 480, 'glasses'),
            'brand' => fake()->company(),
            'color' => fake()->safeColorName(),
        ];
    }
}
