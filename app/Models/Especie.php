<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'nombre_cientifico',
        'image_path'
    ];

    public function setNombreAttributte($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
}
