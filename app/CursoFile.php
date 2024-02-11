<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CursoFile extends Pivot
{
    protected $table = 'curso_files';
}
