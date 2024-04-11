<?php

namespace App\Repositories;

use App\InscriptionPayment;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository {

    /**
     * Returns the last payments
     *
     * @param integer $limit
     * @return void
     */
    public function getLastPayments($limit = 10) :LengthAwarePaginator 
    {
        return InscriptionPayment::with([
            'inscription' => function ($query) {
                $query->with('alumno')->with('curso');
            }])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);

    }
}