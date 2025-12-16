<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\Grid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cell>
 */
class CellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grid_id' => Grid::pluck('id')->random(),
            'component_id' => Component::pluck('id')->random(),
            'x_coordinate' => null,
            'y_coordinate' => null,
        ];
    }
}
