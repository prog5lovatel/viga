<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SobreFoto extends Model
{
    use HasFactory;

    protected $table  = "sobre_fotos";

    protected $fillable = [
        'id',
        'id_sobre',
        'foto',
        'foto_thumb',
        'ordem'
    ];

    public function sobre()
    {
        return $this->belongsTo(Sobre::class, 'id_sobre', 'id');
    }
}
