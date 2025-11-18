<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo' => fake()->imageUrl(200, 200, 'logo'),
            'site_name' => 'Optique Royale',
            'phone' => '+213 ' . fake()->numberBetween(500000000, 799999999),
            'email' => 'contact@optiqueroyale.dz',
            'address' => fake()->streetAddress(),
            'social_links' => [
                'facebook' => 'https://facebook.com/optiqueroyale',
                'instagram' => 'https://instagram.com/optiqueroyale',
            ],
        ];
    }
}
