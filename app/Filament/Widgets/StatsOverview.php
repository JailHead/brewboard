<?php

namespace App\Filament\Widgets;

use App\Models\MenuProduct;
use App\Models\MenuCategory;
use App\Models\Employee;
use App\Models\Inventory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Productos', MenuProduct::count())
                ->description('Productos en el menú')
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('success'),

            Stat::make('Categorías', MenuCategory::count())
                ->description('Categorías de productos')
                ->descriptionIcon('heroicon-m-folder')
                ->color('info'),

            Stat::make('Empleados Activos', Employee::whereNull('deleted_at')->count())
                ->description('Personal registrado')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make('Items con Stock Bajo', Inventory::whereRaw('current_stock <= min_stock')->count())
                ->description('Requieren reabastecimiento')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}