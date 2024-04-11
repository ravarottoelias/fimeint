<?php

namespace App\Repositories;

use App\Inscripcion;
use Illuminate\Support\Facades\DB;
use App\Constants\MPIntegrationConstants;
use App\Constants\PaypalIntegrationConstants;

class InscriptionRepository
{
    public function getInscriptionById($id) 
    {
        return Inscripcion::findOrFail($id);
    }
    
    public function findInscriptionByUserIdCursoId($cursoId, $userId)
    {
        return Inscripcion::where('user_id', $userId)
                ->where('curso_id', $cursoId)
                ->first();
    }

    public function saveInscription($userId, $cursoId, $canal)
    {
        $inscription = new Inscripcion;
        $inscription->user_id = $userId;
        $inscription->curso_id = $cursoId;
        $inscription->canal = $canal;
        $inscription->save();

        return $inscription;
    }

    public function getInscriptionsByStatusToExport($curso, $status)
    {
        $inscripciones = $curso->inscripciones()
                            ->where("estado_del_pago", $status)
                            ->get();

        return $inscripciones;
    } 
    
    public function getInscriptionsWithOutPaymentToExport($curso)
    {
        $inscripciones = $curso->inscripciones()
                            ->where("estado_del_pago", "!=", Inscripcion::PAGADO)
                            ->get();

        return $inscripciones;
    }

    public function getInscriptionsByCursoToExport($curso)
    {
        $inscripciones = $curso->inscripciones()
                            ->get();

        return $inscripciones;
    }

    public function getLastInscriptions($limit = 10)
    {
        return Inscripcion::orderBy('created_at', 'DESC')->paginate($limit);
    }

    /**
     * This method updates the registration depending on the payment status
     *
     * @param [type] $inscription
     * @param [type] $paymentResponse
     * @return Inscripcion
     */
    public function updateInscriptionStatus($inscription, $paymentResponse) : Inscripcion
	{
		if ($paymentResponse['status'] == MPIntegrationConstants::PAYMENT_STATUS_APPROVED || $paymentResponse['status'] == PaypalIntegrationConstants::PP_PAYMENT_STATUS_APPROVED) {
			$amountPaid = $inscription->getAmountPaid();
			$amountPaid >= $inscription->curso->unit_price
				? $inscription->estado_del_pago = Inscripcion::PAGADO
				: $inscription->estado_del_pago = Inscripcion::PAGADO_PARCIAL;
			$inscription->update();
		}

		return $inscription;
	}
}