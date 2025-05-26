<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CursoEstudiante extends Model
{
    use HasFactory;

    protected $table = 'curso_estudiante';

    protected $fillable = [
        'id_curso',
        'id_estudiante',
        'id_periodo',
        'observaciones'
    ];

    // Relación con Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    // Relación con Estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    // Relación con Periodo
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }
}
