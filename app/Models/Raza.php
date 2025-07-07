<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Raza extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'rasgos', 'especie_id'];

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }
}
