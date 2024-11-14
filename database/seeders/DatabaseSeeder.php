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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'ci' => 1,
            'surname' => 'admin',
            'name' => 'admin',
            'username' => 'admin',
            'cellular' => 1,
            'role' => 0,
            'password' => '12345678'
        ]);
    }
}
