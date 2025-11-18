<?php

namespace Database\Seeders;

use App\Models\DeliveryFee;
use Illuminate\Database\Seeder;

class DeliveryFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fees = [
            ['wilaya' => 'Alger', 'home' => 800, 'office' => 600],
            ['wilaya' => 'Oran', 'home' => 900, 'office' => 700],
            ['wilaya' => 'Constantine', 'home' => 950, 'office' => 750],
            ['wilaya' => 'Blida', 'home' => 700, 'office' => 500],
            ['wilaya' => 'Annaba', 'home' => 1000, 'office' => 800],
        ];

        foreach ($fees as $fee) {
            DeliveryFee::updateOrCreate(
                ['wilaya' => $fee['wilaya']],
                [
                    'fee_home' => $fee['home'],
                    'fee_office' => $fee['office'],
                ]
            );
        }
    }
}
