<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Unidade extends Model
{
    use HasFactory;

    protected $table = "unidades";

    protected $fillable = [
        'id',
        'nome',
        'email',
        'telefone',
        'texto',
        'ordem'
    ];

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if($string){
            $builder->where('unidades.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('unidades.ordem', 'ASC');
            $builder->orderBy('unidades.id', 'DESC');
        });
    }
}
