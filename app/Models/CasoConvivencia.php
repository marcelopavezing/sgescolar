<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CasoConvivencia extends Model
{
    protected $casts = [
        'registro_de_llamados' => 'array',
    ];
    protected $table = 'caso_convivencia';

    protected $fillable = [
        'descripcion',
        'fecha_apertura',
        'fecha_cierre',
        'estado',
        'grupal',

        'severidad',
        'fecha_medida_o_suspension',
        'lugar',
        'id_tipo_conflicto',
        'acciones_o_estrategias',
        'fecha_monitoreo',
        'observacion_monitoreo',
        'registro_de_llamados',
    ];

    public function personals(): BelongsToMany
    {
        return $this->belongsToMany(
            Personal::class,
            'caso_personal',
            'caso_id',
            'personal_id'
        )->withTimestamps();
    }

    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(
            Estudiante::class,
            'caso_estudiante',
            'caso_id',
            'estudiante_id'
        )->withTimestamps();
    }

    public function tipoConflicto()
    {
        return $this->belongsTo(TipoConflicto::class, 'id_tipo_conflicto');
    }
}
