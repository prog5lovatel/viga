<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'id',
        'nome',
        'url',
        'foto',
        'ordem'
    ];

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if ($string) {

            $builder->where('clientes.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('clientes.ordem', 'ASC')->orderBy('clientes.id', 'DESC');
        });
    }
}
