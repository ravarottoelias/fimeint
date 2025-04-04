<?php

namespace App\Filters;

use Illuminate\Support\Carbon;

class UserFilter extends QueryFilter
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
        $names = explode(" ", $value);

        return $this->builder
            ->where('email', 'like', $search)
            ->orWhere('name', 'like', $search)
            ->orWhere(function ($query) use ($names) {
                $query->where(function ($q) use ($names) {
                    foreach ($names as $name) {
                        $q->orWhere('surname', 'LIKE', "%$name%");
                    }
                })
                ->where(function ($q) use ($names) {
                    foreach ($names as $name) {
                        $q->orWhere('name', 'LIKE', "%$name%");
                    }
                });
            })
            ->orWhere('documento_nro', $value)
            ->orWhere('cuit', 'like', $search)
            ->orWhere('telefono', 'like', $search);
        
    }

}