<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScriptDePago extends Model
{

    protected $fillable = [
        'titulo', 
        'descripcion', 
        'script',
        'type'
    ];
}
