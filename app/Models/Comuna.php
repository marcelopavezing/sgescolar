<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas';

    protected $fillable = ['nombre', 'id_region'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'ciudad');
    }
}
