<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Banner extends Model
{
    use HasFactory;

    protected $table = "banners";

    protected $fillable = [
        'id',
        'nome',
        'titulo',
        'subtitulo',
        'url',
        'foto_computador',
        'foto_celular',
        'ordem'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome',
                'onUpdate' => true
            ]
        ];
    }

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if ($string) {

            $builder->where('banners.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('banners.ordem', 'ASC')->orderBy('banners.id', 'DESC');
        });
    }
}
