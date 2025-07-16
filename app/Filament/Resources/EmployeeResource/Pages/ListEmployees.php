<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('downloadPdf')
                ->label('Descargar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    return $this->downloadEmployeesPdf();
                }),
        ];
    }

    protected function downloadEmployeesPdf()
    {
        $employees = Employee::with(['role', 'user'])
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView('pdf.employees', compact('employees'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'empleados-' . now()->format('Y-m-d') . '.pdf');
    }
}