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

    public static function mergeCuerpoCertificado($curso)
    {
        $body = $curso->cuerpo_certificado;
        if ($body) {
            $newBody = str_replace(CursoConstants::CURSO_REPLACEMENT, $curso->titulo, $body);
            $newBody = str_replace(CursoConstants::FECHA_INICIO_REPLACEMENT, $curso->fecha_inicio, $newBody);
            $newBody = str_replace(CursoConstants::FECHA_FIN_REPLACEMENT, $curso->fecha_fin, $newBody);
            $newBody = str_replace(CursoConstants::HOMOLOGACION_REPLACEMENT, $curso->curso_homologacion, $newBody);
            return $newBody;
        }
        return $body;
    }
}
