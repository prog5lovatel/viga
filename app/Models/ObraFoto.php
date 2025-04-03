<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObraFoto extends Model
{
    use HasFactory;

    protected $table  = "obras_fotos";

    protected $fillable = [
        'id',
        'id_obra',
        'foto',
        'foto_thumb',
        'ordem'
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'id_obra', 'id');
    }
}
