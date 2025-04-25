<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regiones';

    protected $fillable = ['nombre'];

    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'id_region');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'region');
    }
}
