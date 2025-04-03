<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Obra extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $table = "obras";

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
        return $this->hasMany(ObraFoto::class, 'id_obra', 'id')->orderBy('obras_fotos.ordem', 'ASC')->orderBy('obras_fotos.id', 'ASC');
    }

    public function scopeSearch(Builder $builder, string $string = "")
    {
        if($string){
            $builder->where('obras.nome', 'LIKE', "%{$string}%");
        }

        return $builder;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDefault', function(Builder $builder) {
            $builder->orderBy('obras.ordem', 'ASC');
            $builder->orderBy('obras.id', 'DESC');
        });
    }
}
