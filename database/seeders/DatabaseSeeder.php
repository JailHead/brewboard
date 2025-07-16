<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EmployeeRoleSeeder::class,
            MenuCategorySeeder::class,
            EmployeeSeeder::class
        ]);

        // Crear usuario administrador por defecto
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@brewboard.com',
            'password' => bcrypt('password'),
        ]);
    }
}