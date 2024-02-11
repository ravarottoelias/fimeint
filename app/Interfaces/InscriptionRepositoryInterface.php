<?php

namespace App\Interfaces;

interface InscriptionRepositoryInterface 
{
    public function getInscriptionById($id);
    public function findInscriptionByUserIdCursoId($cursoId, $userId);
    public function saveInscription($userId, $cursoId, $canal);
    public function getLastPayments($limit = 10);
    public function getInscriptionsByStatusToExport($curso, $status);
    public function getInscriptionsByCursoToExport($curso);
    public function getInscriptionsWithOutPaymentToExport($curso);
}