<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $model = strtoupper($this->faker->bothify('??-###')) . 'X';
        $title = $this->faker->randomElement([
            'Heavy Duty Excavator', 'Compact Wheel Loader', 'Crawler Bulldozer',
            'Articulated Dump Truck', 'Motor Grader', 'Mobile Crane',
        ]) . ' ' . $model;

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::lower(Str::random(4)),
            'model_number' => $model,
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'image' => null,
            'specifications' => [
                ['key' => 'Operating Weight', 'value' => $this->faker->numberBetween(8, 45) . ' tons'],
                ['key' => 'Engine Power', 'value' => $this->faker->numberBetween(100, 400) . ' HP'],
                ['key' => 'Bucket Capacity', 'value' => $this->faker->randomFloat(1, 0.5, 4) . ' m³'],
                ['key' => 'Max Digging Depth', 'value' => $this->faker->numberBetween(4, 9) . ' m'],
            ],
            'description' => $this->faker->paragraphs(3, true),
            'is_featured' => $this->faker->boolean(40),
        ];
    }
}
