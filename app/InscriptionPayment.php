<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionPayment extends Model
{
    protected $table = 'inscription_payments';

    protected $fillable = [
        'inscription_id',
        'user_id',
        'payment_identifier',
        'amount',
        'gateway',
        'payload',
        'payment_date',
        'status',
    ];

    public function inscription()
    {
        return $this->belongsTo('App\Inscripcion', 'inscription_id');
    }
}
