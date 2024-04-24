<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $attributes = [
        'estado_del_pago' => self::PENDIENTE
    ];

    const PAGADO = 'Pagado';
    const PAGADO_PARCIAL = 'Pago parcial';
	const PENDIENTE = 'Pendiente';

    public function alumno()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function pagado(){
    	return $this->estado_del_pago == Inscripcion::PAGADO;
    }
    
    public function pagoParcial(){
    	return $this->estado_del_pago == Inscripcion::PAGADO_PARCIAL;
    }
    
    public function pagoPendiente(){
    	return $this->estado_del_pago == Inscripcion::PENDIENTE;
    }

    public function payments()
    {
        return $this->hasMany('App\InscriptionPayment', 'inscription_id');
    }

    public function getAmountPaid()
    {
        return $this->payments()->where('status', 'approved')->sum('amount') / 100;
    }
}
