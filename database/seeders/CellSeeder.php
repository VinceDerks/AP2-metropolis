<?php

namespace Database\Seeders;

use App\Models\Cell;
use App\Models\Grid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grids = Grid::all();
        foreach ($grids as $grid){


            if ($grid->cells()->exists()) {
                continue;
            }

            $max_x = 6;
            $max_y = 3;

            for ($x = 0; $x < $max_x; $x++ ){
                for ($y = 0; $y < $max_y; $y++ ){
                    Cell::factory()->create([
                        'grid_id' => $grid->id,
                        'x_coordinate' => $x,
                        'y_coordinate' => $y,
                    ]);
                }

            }
        }
    }
}
