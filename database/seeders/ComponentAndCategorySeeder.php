<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Component;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ComponentAndCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'safety' => Category::factory()->create([
                'name' => 'Veiligheid'
            ]),
            'recreation' => Category::factory()->create([
                'name' => 'Recreatie'
            ]),
            'environment' => Category::factory()->create([
                'name' => 'Milieukwaliteit'
            ]),
            'provision' => Category::factory()->create([
                'name' => 'Voorziening'
            ]),
            'mobility' => Category::factory()->create([
                'name' => 'Moviliteit'
            ])
        ];

        $path = database_path('data/components.json');

        if (!File::exists($path)) {
            return;
        }

        $components = File::json($path);

        if (is_array($components)) {
            foreach ($components as $component){
                $category = $categories[$component['category']];

                Component::factory()->create([
                    'name' => $component['name'],
                    'safety' => $component['safety'],
                    'recreation' => $component['recreation'],
                    'environment' => $component['environment'],
                    'provision' => $component['provision'],
                    'mobility' => $component['mobility'],
                    "category_id" => $category->id
                ]);
            }
        }
    }
}
