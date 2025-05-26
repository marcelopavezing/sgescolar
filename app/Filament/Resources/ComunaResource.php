<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComunaResource\Pages;
use App\Models\Comuna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ComunaResource extends Resource
{
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?string $model = Comuna::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Comunas';
    protected static ?string $pluralModelLabel = 'Comunas';
    protected static ?string $modelLabel = 'Comuna';

    // Configuración del formulario para crear o editar
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(100),
                
                // Campo para seleccionar una región (relación con la tabla `regiones`)
                Forms\Components\Select::make('id_region')
                    ->label('Región')
                    ->relationship('region', 'nombre') // Asocia la relación con la tabla `regiones`
                    ->required(),
            ]);
    }

    // Configuración de la tabla para el listado
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('region.nombre')->label('Región')->sortable(), // Muestra el nombre de la región asociada
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

    // Define las páginas disponibles
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComunas::route('/'),
            'create' => Pages\CreateComuna::route('/crear'),
            'edit' => Pages\EditComuna::route('/{record}/editar'),
        ];
    }
}
