<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'rut',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'nombre_social',
        'id_genero',
        'id_region',
        'id_ciudad',
        'direccion',
        'estado',
        'observaciones',
    ];

    // Relación con la tabla `generos`
    public function genero()
    {       
        return $this->belongsTo(Genero::class, 'id_genero');
    }

    // Relación con la tabla `regiones`
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    // Relación con la tabla `comunas`
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'id_ciudad');
    }

    // Relación con periodos a través de la tabla pivot
    public function periodos()
    {
        return $this->belongsToMany(Periodo::class, 'periodo_estudiante', 'id_estudiante', 'id_periodo')
            ->withPivot('observaciones', 'promovido')
            ->withTimestamps();
    }

    // Relación con cursos a través de la tabla pivot
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_estudiante', 'id_estudiante', 'id_curso')
            ->withPivot('observaciones')
            ->withTimestamps();
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}