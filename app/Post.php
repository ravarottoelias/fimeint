<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasSlug;

	protected $fillable = ['titulo', 'contenido', 'categoria_id', 'status'];

    const ESTADO_FINALIZADO = 'Finalizado';
    const ESTADO_EN_CURSO = 'En Curso';


    public function portadas()
    {
        return $this->morphMany('App\File', 'notable');
    }


    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['titulo'])
            ->saveSlugsTo('slug');
    }
}
