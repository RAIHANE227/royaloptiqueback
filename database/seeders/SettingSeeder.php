<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['site_name' => 'Optique Royale'],
            [
                'logo' => 'settings/logo.png',
                'phone' => '+213 770 00 00 00',
                'email' => 'contact@optiqueroyale.dz',
                'address' => 'Centre-ville, Alger',
                'social_links' => [
                    'facebook' => 'https://facebook.com/optiqueroyale',
                    'instagram' => 'https://instagram.com/optiqueroyale',
                    'whatsapp' => 'https://wa.me/213770000000',
                ],
            ]
        );
    }
}
