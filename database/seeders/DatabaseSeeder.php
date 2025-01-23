<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Strings;

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
            'role' => Role::ADMIN,
            'password' => '12345678'
        ]);
        User::create([
            'ci' => 2,
            'surname' => 'supervisor',
            'name' => 'supervisor',
            'username' => 'supervisor',
            'cellular' => 1,
            'role' => Role::SUPERVISOR,
            'password' => '12345678'
        ]);
        $u = User::create([
            'ci' => 1111,
            'surname' => 'service',
            'name' => 'service',
            'username' => 'service',
            'password' => str()->random(10),
            'cellular' => 1111,
            'role' => Role::SERVICE
        ]);
        echo "token: ".$u->createToken('service')->plainTextToken.PHP_EOL;
    }
}
