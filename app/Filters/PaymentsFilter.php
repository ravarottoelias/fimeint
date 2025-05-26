<?php

namespace App\Filters;


class PaymentsFilter extends QueryFilter
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
            ->orWhereHas('inscription.alumno', function ($query) use ($search, $value) {
                $query->where('name', 'like', $search)
                    ->orWhere('surname', 'like', $search)
                    ->orWhere('email', $value)
                    ->orWhere('documento_nro', $value)
                    ->orWhere('cuit', $value);
            });
        
    }

    /**
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function paymentIdentifier($value = '')
    {
        if (empty($value)) {
            return $this->builder;
        }

        return $this->builder
            ->where('payment_identifier', $value);
        
    }

    /**
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function cursoId($value = '')
    {
        if (empty($value)) {
            return $this->builder;
        }

        return $this->builder->with('inscription.curso')
            ->whereHas('inscription', function ($query) use ($value) {
                $query->where('curso_id', $value);
            });


        
    }

}