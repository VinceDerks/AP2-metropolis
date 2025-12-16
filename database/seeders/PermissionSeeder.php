<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path = database_path('data/permissions.json');

        if (!File::exists($path)) {
            return;
        }

        $permissions = File::json($path);

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission['name'],
                    'system_name' => $permission['system_name'],
                ]);
            }
        }

    }
}
