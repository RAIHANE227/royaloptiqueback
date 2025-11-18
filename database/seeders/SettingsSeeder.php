<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Optique Royale',
                'phone' => '+213 123 456 789',
                'email' => 'contact@optiqueroyale.dz',
                'address' => '123 Rue des Opticiens, Alger, Algérie',
                'social_links' => [
                    'facebook' => 'https://facebook.com/optiqueroyale',
                    'twitter' => 'https://twitter.com/optiqueroyale',
                    'instagram' => 'https://instagram.com/optiqueroyale',
                    'linkedin' => 'https://linkedin.com/company/optiqueroyale'
                ],
            ]
        );
    }
}
