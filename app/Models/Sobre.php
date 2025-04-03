<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Sobre extends Model
{
    use HasFactory;

    protected $table = "sobre";

    protected $fillable = [
        'id',
        'texto',
        'missao',
        'visao',
        'valores'
    ];

    public function fotos()
    {
        return $this->hasMany(SobreFoto::class, 'id_sobre', 'id')->orderBy('sobre_fotos.ordem', 'ASC')->orderBy('sobre_fotos.id', 'ASC');
    }
}
