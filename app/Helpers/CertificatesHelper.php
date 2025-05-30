<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;


class CertificatesHelper
{
    public function buildResponseCertificates($certificates) {
        $route = route('certificates');
        foreach ($certificates->meta->links as $link) {
            if($link->url != null)
                $link->url = str_replace($certificates->meta->path, $route, $link->url);
        }
        $certificates->links->first = str_replace($certificates->meta->path, $route, $certificates->links->first);
        $certificates->links->last = str_replace($certificates->meta->path, $route, $certificates->links->last);
        $certificates->links->prev = str_replace($certificates->meta->path, $route, $certificates->links->prev);
        $certificates->links->next = str_replace($certificates->meta->path, $route, $certificates->links->next);
        $certificates->meta->path = $route;
        return $certificates;
    }

    public static function buildStoreCertificateRequest($curso, $alumno, $certificadoNumero, $tfCertificadoNumero) {           
        $msRequest = [
            'codigo_qr' => $curso->id . '-' . $alumno->id,
            'cuit_alumno' => str_replace('-', '', $alumno->documento_nro),
            'alumno_id' => $alumno->id,
            'nombre_alumno' => strtoupper($alumno->fullName()),
            'curso_id' => $curso->id,
            'curso_titulo' => $curso->titulo,
            'fecha_curso' => $curso->fecha_inicio, // porbablemente eliminar.
            'curso_total_hs' => $curso->total_hs,
            'curso_fecha_inicio' => $curso->fecha_inicio,
            'curso_fecha_fin' => $curso->fecha_fin,
            'curso_homologacion' => $curso->curso_homologacion,
            'habilitacion_numero' => config('custom.certificates.cert_habilitacion_nro'),
            'certificado_numero' => "$certificadoNumero",
            'tf_certificado_numero' => $tfCertificadoNumero,
            'certificado_body' => CursosHelper::mergeCuerpoCertificado($curso),
        ];

        return $msRequest;
    }

    public static function formatDataCertForPDF($cert)
    {
        $fechaOriginal = $cert->createdAt;

        setlocale(LC_TIME, 'es_ES.UTF-8'); // Asegura el idioma español


        $cert->createdAt = Carbon::parse($fechaOriginal)->formatLocalized('%d de %B de %Y');
        return $cert;
    }
}
