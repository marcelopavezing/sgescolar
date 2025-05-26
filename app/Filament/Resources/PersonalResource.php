<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalResource\Pages;
use App\Models\Personal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;




use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class PersonalResource extends Resource
{
    protected static ?string $model = Personal::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Personal';
    protected static ?string $pluralModelLabel = 'Personal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('rut')->label('RUT')->required()->unique(ignoreRecord: true),
                TextInput::make('nombres')->required(),
                TextInput::make('apellido_paterno')->required(),
                TextInput::make('apellido_materno')->required(),
                Select::make('rol')->options([
                    'docente' => 'Docente',
                    'administrativo' => 'Administrativo',
                    'psicologa' => 'Psicóloga',
                ])->required(),
                TextInput::make('titulo')->required(),
                DatePicker::make('fecha_egreso')->label('Fecha Egreso')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('rut')->label('RUT')->sortable(),
                TextColumn::make('full_name')->label('Nombre Completo')->sortable()->searchable(),
                /*BadgeColumn::make('rol')->label('Rol')->enum([
                    'docente' => 'Docente',
                    'administrativo' => 'Administrativo',
                    'psicologa' => 'Psicóloga',
                ]),*/
                BadgeColumn::make('rol')
    ->label('Rol')
    ->label(fn (?string $state): string => match ($state) {
        'docente' => 'Docente',
        'administrativo' => 'Administrativo',
        'psicologa' => 'Psicóloga',
        null => 'Sin Rol Asignado', // Maneja el caso null
        default => $state, // Maneja otros posibles roles (aunque no deberían ser null)
    })
    ->color(fn (?string $state): string => match ($state) {
        'docente' => 'primary',
        'administrativo' => 'warning',
        'psicologa' => 'success',
        null => 'gray', // Color para el caso null
        default => 'gray', // Color por defecto para otros casos
    }),
                TextColumn::make('titulo')->label('Título'),
                TextColumn::make('fecha_egreso')->date()->label('Fecha de Egreso')->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Creado')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonals::route('/'),
            'create' => Pages\CreatePersonal::route('/crear'),
            'edit' => Pages\EditPersonal::route('/{record}/editar'),
        ];
    }
}
