<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lunettes' => ['Vue', 'Soleil', 'Sport'],
            'Lentilles' => ['Souples', 'Rigides'],
            'Verres médicaux' => ['Monofocaux', 'Progressifs'],
            'Accessoires' => ['Étuis', 'Lingettes'],
        ];

        foreach ($categories as $typeName => $cats) {
            $type = ProductType::firstWhere('name', $typeName);
            if (! $type) {
                continue;
            }

            foreach ($cats as $category) {
                Category::firstOrCreate([
                    'product_type_id' => $type->id,
                    'name' => $category,
                ]);
            }
        }
    }
}
