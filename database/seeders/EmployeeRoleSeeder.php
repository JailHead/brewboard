<?php

namespace Database\Seeders;

use App\Models\EmployeeRole;
use Illuminate\Database\Seeder;

class EmployeeRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'description' => 'Acceso completo al sistema, gestión de usuarios, reportes y configuración'
            ],
            [
                'name' => 'Barista',
                'description' => 'Acceso a órdenes, preparación de productos y actualización de estados'
            ],
            [
                'name' => 'Preparador',
                'description' => 'Acceso a órdenes de preparación y actualización de estados'
            ]
        ];

        foreach ($roles as $role) {
            EmployeeRole::create($role);
        }
    }
}