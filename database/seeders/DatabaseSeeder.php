<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->callOnce([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        $this->addRoleByName(User::factory()->create([
            'first_name' => 'john',
            'middle_name' => 'super user',
            'last_name' => 'doe',
            'email' => 'user@app.com',
        ]), 'super role');

        $this->addRoleByName(User::factory()->create([
            'first_name' => 'jane',
            'last_name' => 'doe',
            'email' => 'library@app.com'
        ]), 'Library Manager');

        $this->call([
            ComponentAndCategorySeeder::class,
            GridSeeder::class,
            CellSeeder::class,
        ]);
    }

    private function addRoleByName(User $user, string $name)
    {
        $roleToAttach =  Role::where('name', '=', $name)->pluck('id')->toArray();
        $user->roles()->attach($roleToAttach);
    }
}
