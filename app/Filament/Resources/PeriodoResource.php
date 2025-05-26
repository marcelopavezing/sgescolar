<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodoResource\Pages;
use App\Models\Periodo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PeriodoResource extends Resource
{
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?string $model = Periodo::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Periodos';
    protected static ?string $pluralModelLabel = 'Periodos';
    protected static ?string $modelLabel = 'Periodo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre del Periodo')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeriodos::route('/'),
            'create' => Pages\CreatePeriodo::route('/crear'),
            'edit' => Pages\EditPeriodo::route('/{record}/editar'),
        ];
    }
};
