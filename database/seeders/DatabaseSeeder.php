<?php

namespace Database\Seeders;

use App\Models\Mascotas;
use App\Models\Raza;
use App\Models\User;
use App\Models\Cliente;
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

        // Cliente::factory(10000)->create();

        // Raza::factory(1000)->create();

        Mascotas::factory(1000)->create();
    }
}
