<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductTypeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            DeliveryFeeSeeder::class,
            SettingSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@optiqueroyale.dz'],
            [
                'name' => 'Administrateur Optique',
                'phone' => '+213 771 00 00 00',
                'role' => Role::ADMIN,
                'password' => Hash::make('MotdepasseSecure!123'),
            ]
        );
    }
}
