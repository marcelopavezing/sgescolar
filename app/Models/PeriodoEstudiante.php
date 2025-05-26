<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriodoEstudiante extends Model
{
    use HasFactory;

    protected $table = 'periodo_estudiante';

    protected $fillable = [
        'id_periodo',
        'id_estudiante',
        'observaciones',
        'promovido'
    ];

    // Relación con Periodo
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }

    // Relación con Estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }
};
