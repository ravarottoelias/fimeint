<?php

namespace App\Filters;

use Illuminate\Support\Carbon;

class PaymentFilter extends QueryFilter
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
            ->where('payment_identifier', $value)
            ->orWhereHas('user', function ($query) use ($value, $search) {
                $query->where('email', 'like', $search)
                    ->orWhere('name', 'like', $search)
                    ->orWhere('surname', 'like', $search)
                    ->orWhere('documento_nro', $value)
                    ->orWhere('cuit', $value)
                    ->orWhere('telefono', $value);
            });
    
    }

}