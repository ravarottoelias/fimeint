<?php
namespace App\Helpers;

use App\Constants\CursoConstants;
use App\Curso;

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


}