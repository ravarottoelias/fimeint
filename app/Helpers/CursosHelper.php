<?php
namespace App\Helpers;

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


}