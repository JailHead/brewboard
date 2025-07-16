<?php

namespace App\Filament\Resources;

use App\Models\Inventory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\InventoryResource\Pages;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Inventario';
    protected static ?string $navigationGroup = 'Gestión de Inventario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('current_stock')
                    ->label('Stock Actual')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('min_stock')
                    ->label('Stock Mínimo')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('max_stock')
                    ->label('Stock Máximo')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stockable_type')
                    ->label('Tipo')
                    ->formatStateUsing(
                        fn(string $state): string =>
                        match ($state) {
                            'App\Models\MenuProduct' => 'Producto',
                            'App\Models\ProductCustomizationOption' => 'Opción',
                            default => $state
                        }
                    ),
                Tables\Columns\TextColumn::make('current_stock')
                    ->label('Stock Actual')
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_stock')
                    ->label('Stock Mínimo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_stock')
                    ->label('Stock Máximo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('stockable_type')
                    ->label('Tipo')
                    ->options([
                        'App\Models\MenuProduct' => 'Producto',
                        'App\Models\ProductCustomizationOption' => 'Opción',
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
            'index' => Pages\ListInventories::route('/'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}