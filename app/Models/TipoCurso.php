<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoCurso extends Model
{
    use HasFactory;

    protected $table = 'tipo_curso';

    protected $fillable = [
        'nombre'
    ];

    // Relación con Cursos
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_tipo');
    }
}
