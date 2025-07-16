<?php

namespace App\Filament\Resources;

use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\EmployeeResource\Pages;
use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Empleados';
    protected static ?string $navigationGroup = 'Gestión de Personal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->nullable(),
                Forms\Components\Select::make('role_id')
                    ->label('Rol')
                    ->relationship('role', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label('Apellido')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthdate')
                    ->label('Fecha de Nacimiento')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->label('Dirección')
                    ->required()
                    ->rows(3),
                Forms\Components\TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('emergency_contact')
                    ->label('Contacto de Emergencia')
                    ->required(),
                Forms\Components\TextInput::make('nss')
                    ->label('NSS')
                    ->required(),
                Forms\Components\DateTimePicker::make('entry_date')
                    ->label('Fecha de Ingreso')
                    ->required(),
                Forms\Components\Select::make('shift')
                    ->label('Turno')
                    ->options([
                        'Matutino' => 'Matutino',
                        'Vespertino' => 'Vespertino',
                        'Nocturno' => 'Nocturno',
                        'Mixto' => 'Mixto',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nombre Completo')
                    ->searchable(['name', 'last_name']),
                Tables\Columns\TextColumn::make('role.name')
                    ->label('Rol')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shift')
                    ->label('Turno'),
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Fecha de Ingreso')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_id')
                    ->label('Rol')
                    ->relationship('role', 'name'),
                Tables\Filters\SelectFilter::make('shift')
                    ->label('Turno')
                    ->options([
                        'Matutino' => 'Matutino',
                        'Vespertino' => 'Vespertino',
                        'Nocturno' => 'Nocturno',
                        'Mixto' => 'Mixto',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}