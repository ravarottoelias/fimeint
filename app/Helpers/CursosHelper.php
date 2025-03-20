<?php
namespace App\Helpers;

use App\Constants\CursoConstants;
use App\Curso;
use App\Inscripcion;
use App\RestClients\MSCertValidation;
use App\User;
use Exception;
use stdClass;

class CursosHelper
{
    
    private static function getCursoByStatus($status)
    {
          $cursos = Curso::where('estado', $status)
                         ->where('publicado', true)
                         ->orderBy('created_at', 'DESC')
                         ->get();

          return $cursos;
    }

    public static function findCursosByStatusProiximo()
    {        
        return CursosHelper::getCursoByStatus(Curso::ESTADO_PROXIMO);
    }
    
    public static function findCursosByStatusEnCurso()
    {
        return CursosHelper::getCursoByStatus(Curso::ESTADO_EN_CURSO);
    }
    
    public static function findCursosByStatusFinalizado()
    {
        return CursosHelper::getCursoByStatus(Curso::ESTADO_FINALIZADO);
    }

    public static function mergeCuerpoCertificado($body)
    {
        if($body){
            $newBody = str_replace(CursoConstants::ALUMNO_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::DNI_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::CUIT_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::CURSO_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::FECHA_INICIO_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::FECHA_FIN_REPLACEMENT, "ELIAS R.-", $body);
            $newBody = str_replace(CursoConstants::HOMOLOGACION_REPLACEMENT, "ELIAS R.-", $body);
            return $newBody;
        }
        return $body;
    }

    public static function generateMassiveCertificates(array $dniList, Curso $curso) : stdClass {
        $result = new stdClass();
        $result->success = [];
        $result->fails = [];
        $client = new MSCertValidation();
        foreach ($dniList as $element) {
            $alumno = null;
            $alumno = User::where('dni', $element->dni)->first();
            if($alumno != null){
                $inscription = null;
                $inscription = Inscripcion::where('user_id', $alumno->id)
                    ->where('curso_id', $curso->id)
                    ->first();
                if($inscription != null) {
                    try{
                        $certificate = $client->createCert(
                            CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, 1, 2)
                        );
                    } catch (Exception $ex) {
                        array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se pudo crear el certificado.');
                    }
                    $inscription->ms_certificate_id = $certificate->id;
                    $inscription->save();
                    array_push($result->success,$element->dni . ' - ' . $element->nombre . '. Certificado creado.');
                } else {
                    array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se encontró inscripción al curso.');
                }
            } else {
                array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se encontró alumno.');
            }
        }

        return $result;
    }


}