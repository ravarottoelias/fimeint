<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    
    use SoftDeletes;
    use HasSlug;

    const ESTADO_PROXIMO = 'Próximo';
    const ESTADO_EN_CURSO = 'En Curso';
    const ESTADO_FINALIZADO = 'Finalizado';
    const PUBLICADO = true;
    const NO_PUBLICADO = false;

	protected $fillable = [
        'titulo', 
        'descripcion', 
        'contenido', 
        'link_mp', 
        'lugar', 
        'categoria_id', 
        'permitir_inscripcion', 
        'estado', 
        'unit_price',
        'publicado',
        'cantidad_cuotas',
    ];

    protected $attributes = [
        'estado' => self::ESTADO_PROXIMO,
        'permitir_inscripcion' => false
    ];


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['titulo'])
            ->saveSlugsTo('slug');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'curso_tags');
    }

    public function foto()
    {
        return $this->hasOne('App\File', 'id', 'foto_id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'notable');
    }

    public function inscripciones()
    {
        return $this->hasMany('App\Inscripcion')->with('alumno');
    }

    public function scriptsDePagos()
    {
        return $this->hasMany('App\ScriptDePago');
    }


}
