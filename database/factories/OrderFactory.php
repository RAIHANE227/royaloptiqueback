<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_price' => fake()->randomFloat(2, 2500, 45000),
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'completed', 'canceled']),
            'customer_name' => fake()->name(),
            'customer_phone' => fake()->phoneNumber(),
            'customer_address' => fake()->address(),
            'prescription_image' => null,
            'delivery_type' => fake()->randomElement(['home', 'office']),
            'wilaya' => fake()->city(),
        ];
    }
}
