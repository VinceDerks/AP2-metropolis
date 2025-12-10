<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'user@app.com',
        ]);

        User::factory([
            'first_name' => 'Mike',
            'last_name' => 'user',
        ]);

        $this->call([
            UserSeeder::class,
            ComponentSeeder::class,
            CellSeeder::class,
            GridSeeder::class,
        ]);
    }
}
