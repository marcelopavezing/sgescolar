<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoEstudianteResource\Pages;
use App\Models\CursoEstudiante;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Periodo;
use Illuminate\Support\Facades\DB;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Carbon\Carbon;

class CursoEstudianteResource extends Resource
{
    protected static ?string $model = CursoEstudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Estudiantes en Cursos';
    protected static ?string $pluralModelLabel = 'Estudiantes en Cursos';
    protected static ?string $modelLabel = 'Estudiante en Curso';

    public static function form(Form $form): Form
    {
        // Get current year for default period selection
        $currentYear = Carbon::now()->format('Y');
        $defaultPeriodId = Periodo::where('nombre', $currentYear)->first()?->id;

        return $form
            ->schema([
                Forms\Components\Select::make('id_curso')
                    ->label('Curso')
                    ->options(function () {
                        // Listar todos los cursos activos
                        return Curso::where('activo', true)
                            ->pluck('nombre', 'id');
                    })
                    ->required(),
                Forms\Components\Select::make('id_periodo')
                    ->label('Periodo')
                    ->options(Periodo::pluck('nombre', 'id'))
                    ->required(),
                
                Forms\Components\Select::make('id_estudiante')
                    ->label('Estudiante')
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search, callable $get): array {
                        $cursoId = $get('id_curso');
                        if (!$cursoId) {
                            return [];
                        }
                        // Obtener los estudiantes ya asignados a este curso
                        $studentsInCurso = DB::table('curso_estudiante')
                            ->where('id_curso', $cursoId)
                            ->pluck('id_estudiante')
                            ->toArray();
                        $lowerSearch = strtolower($search);
                        return Estudiante::where(function ($query) use ($lowerSearch) {
                                $query->whereRaw('LOWER(nombres) LIKE ?', ["%{$lowerSearch}%"])
                                    ->orWhereRaw('LOWER(apellido_paterno) LIKE ?', ["%{$lowerSearch}%"])
                                    ->orWhereRaw('LOWER(apellido_materno) LIKE ?', ["%{$lowerSearch}%"]);
                            })
                            ->when(!empty($studentsInCurso), fn ($q) => $q->whereNotIn('id', $studentsInCurso))
                            ->limit(50)
                            ->get()
                            ->mapWithKeys(fn (Estudiante $estudiante): array => [
                                $estudiante->id => $estudiante->nombres . ' ' . $estudiante->apellido_paterno . ' ' . $estudiante->apellido_materno,
                            ])
                            ->toArray();
                    })
                    ->getOptionLabelUsing(fn ($value): ?string => Estudiante::find($value)?->nombres . ' ' . Estudiante::find($value)?->apellido_paterno . ' ' . Estudiante::find($value)?->apellido_materno)
                    ->required(),
                
                Forms\Components\Textarea::make('observaciones')
                    ->label('Observaciones')
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        // Get current year for default period filter
        $currentYear = Carbon::now()->format('Y');
        $defaultPeriodId = Periodo::where('nombre', $currentYear)->first()?->id;

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                Tables\Columns\TextColumn::make('periodo.nombre')->label('Periodo'),
                Tables\Columns\TextColumn::make('curso.nombre')->label('Curso'),
                Tables\Columns\TextColumn::make('curso.tipo.nombre')->label('Tipo de Curso'),
                Tables\Columns\TextColumn::make('estudiante.nombres')->label('Nombres'),
                Tables\Columns\TextColumn::make('estudiante.apellido_paterno')->label('Apellido Paterno'),
                Tables\Columns\TextColumn::make('estudiante.apellido_materno')->label('Apellido Materno'),
                Tables\Columns\TextColumn::make('observaciones')->label('Observaciones')->limit(30),
            ])
            ->filters([
                SelectFilter::make('id_periodo')
                    ->label('Periodo')
                    ->relationship('periodo', 'nombre')
                    ->default($defaultPeriodId),
                
                SelectFilter::make('curso')
                    ->label('Curso')
                    ->relationship('curso', 'nombre')
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
            'index' => Pages\ListCursoEstudiantes::route('/'),
            'create' => Pages\CreateCursoEstudiante::route('/crear'),
            'edit' => Pages\EditCursoEstudiante::route('/{record}/editar'),
        ];
    }
}
