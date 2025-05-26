<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoConflictoResource\Pages;
use App\Models\TipoConflicto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TipoConflictoResource extends Resource
{
    protected static ?string $navigationGroup = 'Configuración';
    
    protected static ?string $model = TipoConflicto::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'Tipos de Conflicto';
    protected static ?string $pluralModelLabel = 'Tipos de Conflicto';
    protected static ?string $modelLabel = 'Tipo de Conflicto';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
        ])
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
            'index' => Pages\ListTipoConflictos::route('/'),
            'create' => Pages\CreateTipoConflicto::route('/create'),
            'edit' => Pages\EditTipoConflicto::route('/{record}/edit'),
        ];
    }
}
