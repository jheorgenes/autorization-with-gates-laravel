<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Usuario',
            'email' => 'user@gmail.com',
            'password' => bcrypt('Aa123456'),
            'role' => 'user',
            'permissions' => 'user'
        ]);
    }
}
