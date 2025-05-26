<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsignaturaResource\Pages;
use App\Models\Asignatura;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AsignaturaResource extends Resource
{
    protected static ?string $navigationGroup = 'Configuración';
    
    protected static ?string $model = Asignatura::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Asignaturas';
    protected static ?string $pluralModelLabel = 'Asignaturas';
    protected static ?string $modelLabel = 'Asignatura';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(100),
                
                Forms\Components\Textarea::make('observacion')
                    ->label('Observación')
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('observacion')->label('Observación')->limit(50),
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
            'index' => Pages\ListAsignaturas::route('/'),
            'create' => Pages\CreateAsignatura::route('/crear'),
            'edit' => Pages\EditAsignatura::route('/{record}/editar'),
        ];
    }
}
