<?php

namespace Database\Factories;

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
            'liveability' => fake()->numberBetween(1, 100),
            'well_being' => fake()->numberBetween(1, 100),
            'economic' => fake()->numberBetween(1, 100),
            'sustainability' => fake()->numberBetween(1, 100),
        ];
    }
}
