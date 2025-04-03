<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Setor extends Model
{
    use HasFactory;

    protected $table = "Setores";

    protected $fillable = [
        'id',
        'nome',
        'email'
    ];

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if ($string) {

            $builder->where('Setores.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('Setores.nome', 'ASC');
        });
    }
}
