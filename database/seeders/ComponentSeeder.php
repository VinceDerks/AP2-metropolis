<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $safety = Category::factory()->create([
            'name' => 'Veiligheid'
        ]);

        $recreation = Category::factory()->create([
            'name' => 'Recreatie'
        ]);

        $environment = Category::factory()->create([
            'name' => 'Milieukwaliteit'
        ]);

        $provision = Category::factory()->create([
            'name' => 'Voorziening'
        ]);

        $mobility = Category::factory()->create([
            'name' => 'Moviliteit'
        ]);

        $seederComponents = [
            [
                'name' => 'Politiebureau',
                'liveability' => '',
                'well_being' => '',
                'economic' => '',
                'sustainability' => '',
                'category_id' => $safety->id,
            ],
            [

            ]
        ];

    }
}
