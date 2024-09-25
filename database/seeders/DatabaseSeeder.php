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
            'name' => 'Workers Admin',
            'email' => 'admin@apworkers.com',
            'password' => 'admin2024',
        ]);
        User::factory()->create([
            'name' => 'Workers Dev',
            'email' => 'web',
            'password' => 'restore',
        ]);
    }
}
