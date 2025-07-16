<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario admin con empleado
        $adminUser = User::where('email', 'admin@brewboard.com')->first();
        $adminRole = EmployeeRole::where('name', 'Administrador')->first();

        if ($adminUser && $adminRole) {
            Employee::create([
                'user_id' => $adminUser->id,
                'role_id' => $adminRole->id,
                'name' => 'Admin',
                'last_name' => 'Sistema',
                'birthdate' => '1990-01-01',
                'address' => 'Dirección de ejemplo',
                'phone' => '1234567890',
                'emergency_contact' => 'Contacto de emergencia',
                'nss' => '12345678901',
                'entry_date' => now(),
                'shift' => 'Matutino',
            ]);
        }

        // Crear barista de ejemplo
        $baristaUser = User::create([
            'name' => 'María González',
            'email' => 'barista@brewboard.com',
            'password' => bcrypt('password'),
        ]);

        $baristaRole = EmployeeRole::where('name', 'Barista')->first();

        Employee::create([
            'user_id' => $baristaUser->id,
            'role_id' => $baristaRole->id,
            'name' => 'María',
            'last_name' => 'González',
            'birthdate' => '1995-03-15',
            'address' => 'Calle Ejemplo 123',
            'phone' => '9876543210',
            'emergency_contact' => 'Juan González - 5555555555',
            'nss' => '98765432109',
            'entry_date' => now()->subMonths(6),
            'shift' => 'Matutino',
        ]);
    }
}