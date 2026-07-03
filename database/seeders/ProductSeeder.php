<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['title' => 'Prime XL 950 Excavator', 'category' => 'Excavators', 'model' => 'XL-950', 'featured' => true],
            ['title' => 'Titan 620 Excavator', 'category' => 'Excavators', 'model' => 'TT-620', 'featured' => false],
            ['title' => 'Apex WL 340 Wheel Loader', 'category' => 'Wheel Loaders', 'model' => 'WL-340', 'featured' => true],
            ['title' => 'Summit BD 780 Bulldozer', 'category' => 'Bulldozers', 'model' => 'BD-780', 'featured' => true],
            ['title' => 'Vertex BD 500 Bulldozer', 'category' => 'Bulldozers', 'model' => 'BD-500', 'featured' => false],
            ['title' => 'Regal MC 200 Mobile Crane', 'category' => 'Cranes', 'model' => 'MC-200', 'featured' => true],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'model_number' => $item['model'],
                'category_id' => $category->id,
                'image' => null,
                'specifications' => [
                    ['key' => 'Operating Weight', 'value' => fake()->numberBetween(8, 45) . ' tons'],
                    ['key' => 'Engine Power', 'value' => fake()->numberBetween(100, 400) . ' HP'],
                    ['key' => 'Bucket Capacity', 'value' => fake()->randomFloat(1, 0.5, 4) . ' m³'],
                    ['key' => 'Max Digging Depth', 'value' => fake()->numberBetween(4, 9) . ' m'],
                ],
                'description' => fake()->paragraphs(3, true),
                'is_featured' => $item['featured'],
            ]);
        }
    }
}
