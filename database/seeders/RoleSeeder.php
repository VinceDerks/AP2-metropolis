<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path = database_path('data/roles.json');

        if (!File::exists($path)) {
            return;
        }

        $roles = File::json($path);

        if (is_array($roles)) {
            foreach ($roles as $role) {

                $createdRole = Role::firstOrCreate([
                    'name' => $role['name']
                ]);

                $permissions = $role['permissions'] ?? [];

                if ($permissions === '*') {
                    $allPermissionIds = Permission::pluck('id')->toArray();
                    $createdRole->permissions()->sync($allPermissionIds);
                    continue;
                }

                if (!is_array($permissions)) {
                    continue;
                }

                $permissionIdsToSync = [];

                foreach ($permissions as $permission) {

                    if (str_ends_with($permission, '.*')) {
                        $likePattern = str_replace('.*', '', $permission) . '.%';

                        $matchingIds = Permission::where('system_name', 'like', $likePattern)
                            ->pluck('id')
                            ->toArray();

                        $permissionIdsToSync = array_merge($permissionIdsToSync, $matchingIds);

                    } else {
                        $specificId = Permission::where('system_name', '=', $permission)
                            ->value('id');

                        if ($specificId !== null) {
                            $permissionIdsToSync[] = $specificId;
                        }
                    }
                }

                if (!empty($permissionIdsToSync)) {
                    $createdRole->permissions()->sync(array_unique($permissionIdsToSync));
                } else {
                    $createdRole->permissions()->sync([]);
                }
            }
        }

    }
}
