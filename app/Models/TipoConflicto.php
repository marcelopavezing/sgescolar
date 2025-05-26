<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoConflicto extends Model
{
    use HasFactory;

    protected $table = 'tipo_conflicto';

    protected $fillable = [
        'nombre'
    ];

    public function tipoConfictos()
    {
        return $this->hasMany(Curso::class, 'id_tipo_conflicto');
    }

};
