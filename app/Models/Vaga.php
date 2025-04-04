<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Vaga extends Model
{
    use HasFactory;

    protected $table = "vagas";

    protected $fillable = [
        'id',
        'nome',
        'texto'
    ];

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if ($string) {

            $builder->where('vagas.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('vagas.nome', 'ASC');
        });
    }
}
