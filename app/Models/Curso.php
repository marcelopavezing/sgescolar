<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'id_tipo',
        'activo',
    ];

    // Relación con TipoCurso
    public function tipo()
    {
        return $this->belongsTo(TipoCurso::class, 'id_tipo');
    }

    // Relación con Estudiantes
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'curso_estudiante', 'id_curso', 'id_estudiante')
            ->withPivot('observaciones')
            ->withTimestamps();
    }
}
