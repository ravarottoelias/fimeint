<?php

namespace App\Filters;

use Illuminate\Support\Carbon;

class CursoFilter extends QueryFilter
{

    /**
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function searchFor($value = '')
    {
        if (empty($value)) {
            return $this->builder;
        }

        $search = '%' . $value . '%';

        return $this->builder
            ->where('titulo', 'like', $search)
            ->orWhere('descripcion', 'like', $search)
            ->orWhere('contenido', 'like', $search);
        
    }

}