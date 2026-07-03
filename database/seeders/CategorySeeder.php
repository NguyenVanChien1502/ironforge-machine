<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        collect(['Excavators', 'Wheel Loaders', 'Bulldozers', 'Cranes'])
            ->each(fn ($name) => Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]));
    }
}
