<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\EmployeeRole;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EmployeesByRoleChart extends ChartWidget
{
    protected static ?string $heading = 'Empleados por Rol';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $employeesByRole = Employee::whereNull('deleted_at')
            ->join('erp_employee_roles', 'erp_employees.role_id', '=', 'erp_employee_roles.id')
            ->select('erp_employee_roles.name as role_name', DB::raw('count(*) as total'))
            ->groupBy('erp_employee_roles.name')
            ->get();

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($employeesByRole as $role) {
            $labels[] = $role->role_name;
            $data[] = $role->total;

            // Color especial para administradores si hay más de 2
            if ($role->role_name === 'Administrador' && $role->total > 2) {
                $colors[] = '#ef4444'; // Rojo de alerta
            } else {
                $colors[] = match ($role->role_name) {
                    'Administrador' => '#10b981',
                    'Barista' => '#3b82f6',
                    'Preparador' => '#f59e0b',
                    default => '#6b7280'
                };
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de Empleados',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => $colors,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            return context.label + ": " + context.parsed + " empleados";
                        }'
                    ]
                ]
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }

    // Mostrar alerta si hay más de 2 administradores
    public function getDescription(): ?string
    {
        $adminCount = Employee::whereNull('deleted_at')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Administrador');
            })
            ->count();

        if ($adminCount > 2) {
            return '⚠️ Alerta: Hay más de 2 administradores registrados (' . $adminCount . ')';
        }

        return 'Distribución actual del personal por roles';
    }
}