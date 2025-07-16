<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\Widget;

class AdminCountAlert extends Widget
{
    protected static string $view = 'filament.widgets.admin-count-alert';
    protected static ?int $sort = 1;

    public function getAdminCount(): int
    {
        return Employee::whereNull('deleted_at')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Administrador');
            })
            ->count();
    }

    public function shouldShowAlert(): bool
    {
        return $this->getAdminCount() > 2;
    }
}