<?php

namespace App\Filters;


class ConcursoFilter extends QueryFilter
{

    /**
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function status($value = '')
    {
        if (empty($value)) {
            return $this->builder;
        }

        return $this->builder
            ->where('status',  $value);
        
    }

}