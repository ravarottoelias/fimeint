<?php

namespace App\Repositories;

use App\Inscripcion;
use Illuminate\Support\Facades\DB;
use App\Interfaces\InscriptionRepositoryInterface;

class InscriptionRepository implements InscriptionRepositoryInterface 
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

    public function getLastPayments($limit = 10)
    {
        $pagado = Inscripcion::PAGADO;

        return  DB::select(
            DB::raw("SELECT i.id inscriptionId, i.user_id as userId, i.curso_id as cursoId, i.estado_del_pago as paymentSatus, i.fecha_del_pago as paymentDate, 
                        i.payment_status_mp as paymentStatusMP, i.payment_id_mp as paymentIdMP, u.name as userName, u.email userEmail, c.titulo as cursoTitle  
                    FROM inscripciones i 
                    INNER JOIN cursos c ON c.id = i.curso_id 
                    INNER JOIN users u ON u.id = i.user_id 
                    WHERE i.estado_del_pago = '$pagado'
                    ORDER BY i.fecha_del_pago DESC
                    LIMIT $limit"
            )
       );

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
}