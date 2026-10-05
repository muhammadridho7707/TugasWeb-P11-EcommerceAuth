<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = ucwords(fake()->unique()->words(3, true));

        return [
            'category_id' => Category::factory(),
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . fake()->unique()->numberBetween(100, 99999),
            'sku'         => strtoupper(fake()->unique()->bothify('SKU-????-####')),
            'description' => fake()->paragraph(3),
            'price'       => fake()->numberBetween(15, 5000) * 1000,
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => true,
        ];
    }
}