<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoResource\Pages;
use App\Models\Curso;
use App\Models\Periodo;
use App\Models\TipoCurso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CursoResource extends Resource
{
    protected static ?string $navigationGroup = 'Configuración';
    
    protected static ?string $model = Curso::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Cursos';
    protected static ?string $pluralModelLabel = 'Cursos';
    protected static ?string $modelLabel = 'Curso';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(100),
                
                Forms\Components\Select::make('id_tipo')
                    ->label('Tipo de Curso')
                    ->options(TipoCurso::pluck('nombre', 'id'))
                    ->required(),
                
                Forms\Components\Checkbox::make('activo')
                    ->label('Activo')
                    ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('tipo.nombre')->label('Tipo de Curso'),
                Tables\Columns\BooleanColumn::make('activo')->label('Activo'),
                Tables\Columns\TextColumn::make('estudiantes_count')
                    ->label('Alumnos')
                    ->counts('estudiantes'),
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
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/crear'),
            'edit' => Pages\EditCurso::route('/{record}/editar'),
        ];
    }
}
