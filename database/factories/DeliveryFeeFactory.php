<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryFee>
 */
class DeliveryFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wilaya' => fake()->city(),
            'fee_home' => fake()->randomFloat(2, 300, 1200),
            'fee_office' => fake()->randomFloat(2, 200, 900),
        ];
    }
}
