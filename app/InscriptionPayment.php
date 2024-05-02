<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class InscriptionPayment extends Model
{
    use Filterable;
    
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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function getAmountAttribute($value)
    {
        return $value / 100;
    }
}
