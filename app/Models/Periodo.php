<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodos';

    protected $fillable = [
        'nombre'
    ];

    // Relación con estudiantes a través de la tabla pivot
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'periodo_estudiante', 'id_periodo', 'id_estudiante')
            ->withPivot('observaciones', 'promovido')
            ->withTimestamps();
    }
};
