<?php

namespace App\Filters;

use Illuminate\Support\Carbon;

class FileFilter extends QueryFilter
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
            ->where('name', 'like', $search);
        
    }

}