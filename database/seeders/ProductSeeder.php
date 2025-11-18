<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'type' => 'Lunettes',
                'category' => 'Vue',
                'name' => 'Lunettes de vue Élégance',
                'description' => 'Monture légère en acétate avec verres anti-reflets idéal pour un port quotidien.',
                'price' => 15990,
                'stock' => 25,
                'brand' => 'OptiLux',
                'color' => 'Noir mat',
                'image' => 'images/produits/lunettes-elegance.jpg',
            ],
            [
                'type' => 'Lunettes',
                'category' => 'Soleil',
                'name' => 'Lunettes de soleil Riviera',
                'description' => 'Protection UV400 avec monture métallique dorée et branches ajustables.',
                'price' => 18990,
                'stock' => 15,
                'brand' => 'SunWave',
                'color' => 'Doré',
                'image' => 'images/produits/riviera.jpg',
            ],
            [
                'type' => 'Lentilles',
                'category' => 'Souples',
                'name' => 'Lentilles Confort 24h',
                'description' => 'Lentilles journalières hydratées pour un confort maximal.',
                'price' => 7990,
                'stock' => 80,
                'brand' => 'VisionClear',
                'color' => 'Transparent',
                'image' => 'images/produits/lentilles-confort.jpg',
            ],
            [
                'type' => 'Verres médicaux',
                'category' => 'Progressifs',
                'name' => 'Verres progressifs Premium',
                'description' => 'Correction multi-distance avec filtre lumière bleue pour usage numérique.',
                'price' => 24990,
                'stock' => 30,
                'brand' => 'BlueCare',
                'color' => 'Translucide',
                'image' => 'images/produits/verres-premium.jpg',
            ],
            [
                'type' => 'Accessoires',
                'category' => 'Étuis',
                'name' => 'Étui premium en cuir',
                'description' => 'Étui rigide en cuir végétal avec intérieur velours.',
                'price' => 2990,
                'stock' => 60,
                'brand' => 'RoyalCase',
                'color' => 'Marron',
                'image' => 'images/produits/etui-cuir.jpg',
            ],
        ];

        foreach ($products as $data) {
            $type = ProductType::firstWhere('name', $data['type']);
            $category = Category::where('name', $data['category'])
                ->where('product_type_id', optional($type)->id)
                ->first();

            if (! $type || ! $category) {
                continue;
            }

            $product = Product::updateOrCreate(
                ['name' => $data['name']],
                [
                    'product_type_id' => $type->id,
                    'category_id' => $category->id,
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'image' => $data['image'],
                    'brand' => $data['brand'],
                    'color' => $data['color'],
                ]
            );

            ProductImage::firstOrCreate(
                [
                    'product_id' => $product->id,
                    'image' => $data['image'],
                ],
                ['is_primary' => true]
            );
        }
    }
}
