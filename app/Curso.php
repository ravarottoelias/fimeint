<?php

namespace App;

use App\Traits\Filterable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    use Filterable;
    use HasSlug;

    const ESTADO_PROXIMO = 'Próximo';
    const ESTADO_EN_CURSO = 'En Curso';
    const ESTADO_FINALIZADO = 'Finalizado';
    const PUBLICADO = 1;
    const NO_PUBLICADO = 0;

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
        'fecha_inicio',
        'fecha_fin',
        'total_hs',
        'curso_homologacion',
        'cuerpo_certificado',
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

    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = $value * 100;
    }

    public function getUnitPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Calculate the value of the two course fees
     *
     * @return float
     */
    public function calcularValorCuota() : float
    {
        return ($this->unit_price + $this->unit_price * config('custom.payments.course_fee_tax')) / 2;
    }

    public function isFinalizado() {
        return $this->estado == self::ESTADO_FINALIZADO;
    }


}
