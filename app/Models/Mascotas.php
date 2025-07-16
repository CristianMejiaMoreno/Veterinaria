<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascotas extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'especie_id',
        'raza_id',
        'cliente_id',
        'nombre',
        'fecha_nacimiento',
        'edad',
        'sexo'
    ];
    

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }

    public function raza()
    {
        return $this->belongsTo(Raza::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
