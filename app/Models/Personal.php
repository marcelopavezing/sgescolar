<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Personal extends Model
{
    protected $table = 'personal';

    protected $fillable = [
        'rut',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'rol',
        'titulo',
        'fecha_egreso',
    ];

    public function casos(): BelongsToMany
    {
        return $this->belongsToMany(
            CasoConvivencia::class,
            'caso_personal',
            'personal_id',
            'caso_id'
        )->withTimestamps();
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}
