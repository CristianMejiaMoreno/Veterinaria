<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'nombre',
        'email',
        'direccion',
        'telefono'
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = strtoupper($value);
    }
}
