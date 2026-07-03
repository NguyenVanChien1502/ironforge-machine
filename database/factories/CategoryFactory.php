<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Excavators', 'Wheel Loaders', 'Bulldozers', 'Motor Graders', 'Cranes', 'Dump Trucks',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
