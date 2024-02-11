<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
	use HasSlug;

	/**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso', 'curso_tags');
    }

}
