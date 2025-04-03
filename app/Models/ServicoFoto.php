<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoFoto extends Model
{
    use HasFactory;

    protected $table  = "servicos_fotos";

    protected $fillable = [
        'id',
        'id_servico',
        'foto',
        'foto_thumb',
        'ordem'
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servico', 'id');
    }
}
