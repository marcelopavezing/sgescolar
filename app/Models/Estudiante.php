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
        'genero',
        'region',
        'ciudad',
        'direccion',
        'estado',
        'observaciones',
    ];

    // Relación con la tabla `generos`
    public function genero()
    {       
        return $this->belongsTo(Genero::class);

    }

    // Relación con la tabla `regiones`
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Relación con la tabla `comunas`
    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }
}