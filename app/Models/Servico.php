<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Servico extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $table = "servicos";

    protected $fillable = [
        'id',
        'nome',
        'slug',
        'texto',
        'foto',
        'foto_thumb',
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

    public function fotos()
    {
        return $this->hasMany(ServicoFoto::class, 'id_servico', 'id')->orderBy('servicos_fotos.ordem', 'ASC')->orderBy('servicos_fotos.id', 'ASC');
    }

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if($string){
            $builder->where('servicos.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('servicos.ordem', 'ASC');
            $builder->orderBy('servicos.id', 'DESC');
        });
    }
}
