<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CasoConvivenciaResource\Pages;
use App\Models\CasoConvivencia;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class CasoConvivenciaResource extends Resource
{
    protected static ?string $model = CasoConvivencia::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Convivencia Escolar';
    protected static ?string $pluralModelLabel = 'Casos de Convivencia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'abierto'    => 'Abierto',
                        'en curso'   => 'En Curso',
                        'resuelto'   => 'Resuelto',
                    ])
                    ->required(),
                DatePicker::make('fecha_apertura')
                ->label('Fecha de Apertura')
                ->required(),
                DatePicker::make('fecha_cierre')
                    ->label('Fecha de Cierre'),
                DatePicker::make('fecha_monitoreo')
                ->label('Fecha de Monitoreo'),
            Textarea::make('observacion_monitoreo')
                ->label('Observación Monitoreo')
                ->rows(5)
                ->columnSpanFull(),
                Select::make('id_tipo_conflicto')
                    ->label('Tipo de Conflicto')
                    ->relationship('tipoConflicto', 'nombre', fn ($query) => $query->orderBy('nombre'))
                    ->searchable()
                    ->preload(),
                DatePicker::make('fecha_medida_o_suspension')
                    ->label('Fecha de Medida/Suspensión'),
                Textarea::make('lugar')
                    ->label('Lugar')
                    ->rows(5),
                
                Textarea::make('acciones_o_estrategias')
                    ->label('Acciones o Estrategias')
                    ->rows(5),
               
               
                
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull()
                    ->rows(10),
                

                Toggle::make('grupal')
                    ->label('Grupal'),

                Select::make('severidad')
                    ->label('Nivel de Severidad')
                    ->options([
                        'baja'  => 'Baja',
                        'media' => 'Media',
                        'alta'  => 'Alta',
                    ]),

                MultiSelect::make('personals')
                    ->relationship('personals', 'id') // usa 'id' como key
                    ->label('Personal a Cargo')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name ?? 'Sin Nombre')
                    ->preload(),

                MultiSelect::make('estudiantes')
                    ->relationship('estudiantes', 'id')
                    ->label('Estudiantes Involucrados')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name ?? 'Sin Nombre')
                    ->preload(),
                Forms\Components\Repeater::make('registro_de_llamados')
                    ->label('Registro de Llamados')
                    ->schema([
                        Forms\Components\TextInput::make('nombre_contacto')->label('Nombre Contacto'),
                        Forms\Components\TextInput::make('numero_telefono')->label('Número Teléfono'),
                        Forms\Components\DatePicker::make('fecha')->label('Fecha'),
                        Forms\Components\TimePicker::make('hora')->label('Hora'),
                        Forms\Components\Textarea::make('observacion_llamados')->label('Observación')->columnSpanFull()->rows(5),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'abierto' => 'warning',
                        'en curso' => 'info',
                        'resuelto' => 'success',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'abierto' => 'Abierto',
                        'en curso' => 'En Curso',
                        'resuelto' => 'Resuelto',
                        default => $state,
                    }),
               // TextColumn::make('severidad')->label('Severidad'),
                BadgeColumn::make('severidad')
                    ->label('Severidad')
                    ->colors([
                        'alto' => 'warning',
                        'medio' => 'info',
                        'bajo' => 'success',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'alto' => 'Abierto',
                        'medio' => 'En Curso',
                        'bajo' => 'Resuelto',
                        default => $state,
                    }),
                TextColumn::make('fecha_apertura')->label('Fecha Apertura')->date('Y-m-d')->sortable(),
                TextColumn::make('fecha_medida_o_suspension')->label('Fecha Medida/Suspensión')->date('Y-m-d'),
                TextColumn::make('fecha_cierre')->label('Fecha Cierre')->date('Y-m-d')->sortable(),
                TextColumn::make('tipoConflicto.nombre')->label('Tipo Conflicto'),
                TextColumn::make('lugar')->label('Lugar'),
                TextColumn::make('acciones_o_estrategias')->label('Acciones/Estrategias')->limit(30),
                TextColumn::make('fecha_monitoreo')->label('Fecha Monitoreo')->date('Y-m-d'),
               // TextColumn::make('observacion_monitoreo')->label('Obs. Monitoreo')->limit(30),
               // TextColumn::make('registro_de_llamados')->label('Llamados')->formatStateUsing(fn($state) => is_array($state) ? count(implode(',', $state)) . ' llamados' : $state.'0 llamados'),
               TextColumn::make('registro_de_llamados')->label('Llamados')->formatStateUsing(function ($state) {
                $registros = is_string($state) ? json_decode($state, true) : $state;
                if (is_array($registros)) {
                    return count($registros) . ' llamados';
                }
                if(is_string($state)){
                    return '2 llamadas';
                 //   return count(json_decode($state, true));
                }
                return '0 llamados';
            }),
               
               //TextColumn::make('descripcion')->label('Descripción')->limit(50),
              /*  \Filament\Tables\Columns\IconColumn::make('grupal')
                ->label('Grupal')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger')
                ->label('Grupal'),*/
                TextColumn::make('personals_count')
                    ->label('Personal a Cargo')
                    ->counts('personals'),
                TextColumn::make('estudiantes_count')
                    ->label('Estudiantes')
                    ->counts('estudiantes'),
            ])
            ->filters([
                SelectFilter::make('estado')
    ->label('Estado')
    ->options([
        'abierto'    => 'Abierto',
        'en curso'   => 'En Curso',
        'resuelto'   => 'Resuelto',
    ]),
    SelectFilter::make('tipoConflicto')
    ->label('Tipo')
    ->relationship('tipoConflicto', 'nombre')
    ,
    SelectFilter::make('severidad')
    ->label('Severidad')
    ->options([
        'baja'  => 'Baja',
        'media' => 'Media',
        'alta'  => 'Alta',
    ]),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make()->label('Editar'),
                \Filament\Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCasoConvivencias::route('/'),
            'create' => Pages\CreateCasoConvivencia::route('/create'),
            'edit' => Pages\EditCasoConvivencia::route('/{record}/edit'),
            'print-registro-llamados' => Pages\PrintRegistroLlamados::route('/{record}/print-registro-llamados'),
        ];
    }
}
