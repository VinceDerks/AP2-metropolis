<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'safety' => fake()->numberBetween(-5, 5),
            'recreation' => fake()->numberBetween(-5, 5),
            'environment' => fake()->numberBetween(-5, 5),
            'provision' =>fake()->numberBetween(-5, 5),
            'mobility' => fake()->numberBetween(-5, 5),
            'category_id' => Category::pluck('id')->random(),
            'image_path' => fake()->randomElement(['component-seeder']),
        ];
    }
}
