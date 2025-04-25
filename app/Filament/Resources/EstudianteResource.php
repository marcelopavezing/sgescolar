<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Models\Estudiante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Estudiantes';
    protected static ?string $pluralModelLabel = 'Estudiantes';
    protected static ?string $modelLabel = 'Estudiante';

    // Configuración del formulario para crear o editar
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rut')
                    ->label('RUT')
                    ->required()
                    ->maxLength(15),
                
                Forms\Components\TextInput::make('nombres')
                    ->label('Nombres')
                    ->required()
                    ->maxLength(100),
                
                Forms\Components\TextInput::make('apellido_paterno')
                    ->label('Apellido Paterno')
                    ->required()
                    ->maxLength(100),
                
                Forms\Components\TextInput::make('apellido_materno')
                    ->label('Apellido Materno')
                    ->required()
                    ->maxLength(100),
                
                Forms\Components\TextInput::make('nombre_social')
                    ->label('Nombre Social')
                    ->maxLength(100),
                
                // Campo de selección para el género (relación con la tabla `generos`)
                Forms\Components\Select::make('genero')
                    ->label('Género')
                    ->relationship('genero', 'nombre')
                    ->required(),
                
                // Campo de selección para la región (relación con la tabla `regiones`)
                Forms\Components\Select::make('region')
                    ->label('Región')
                    ->relationship('region', 'nombre')
                    ->required(),
                
                // Campo de selección para la comuna (relación con la tabla `comunas`)
                Forms\Components\Select::make('ciudad')
                    ->label('Comuna')
                    ->relationship('comuna', 'nombre')
                    ->required(),
                
                Forms\Components\TextInput::make('direccion')
                    ->label('Dirección')
                    ->maxLength(200),
                
                Forms\Components\Checkbox::make('estado')
                    ->label('Estado')
                    ->default(true),
                
                Forms\Components\Textarea::make('observaciones')
                    ->label('Observaciones')
                    ->maxLength(1000),
            ]);
    }

    // Configuración de la tabla para el listado
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('nombres')->label('Nombres'),
                Tables\Columns\TextColumn::make('apellido_paterno')->label('Apellido Paterno'),
                Tables\Columns\TextColumn::make('apellido_materno')->label('Apellido Materno'),
                Tables\Columns\TextColumn::make('nombre_social')->label('Nombre Social'),
                Tables\Columns\TextColumn::make('genero.nombre')->label('Género'),
                Tables\Columns\TextColumn::make('region.nombre')->label('Región'),
                Tables\Columns\TextColumn::make('comuna.nombre')->label('Comuna'),
                Tables\Columns\TextColumn::make('estado')->label('Estado')->sortable(),
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
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/crear'),
            'edit' => Pages\EditEstudiante::route('/{record}/editar'),
        ];
    }
}
