<?php

declare(strict_types=1);

namespace App\Helpers;

use App\User;
use stdClass;
use App\Curso;
use Exception;
use App\Inscripcion;
use App\RestClients\MSCertValidation;

class CursoService
{
    private $msCertValidationClient;

    function __construct(MSCertValidation $msCertValidationClient) {
        $this->msCertValidationClient = $msCertValidationClient;
    }

    public function generateMassiveCertificates(array $dniList, Curso $curso) : stdClass {
        $result = new stdClass();
        $result->success = [];
        $result->fails = [];
        $lastCertificateNumber = Utils::getSetting('last_certificate_number');
        $lastCertificateTomo = Utils::getSetting('last_certificate_tomo');
        $lastCertificateFolio = Utils::getSetting('last_certificate_folio');
        foreach ($dniList as $element) {
            $alumno = null;
            $alumno = User::where('documento_nro', $element->dni)->first();
            if($alumno != null){
                $inscription = null;
                $inscription = Inscripcion::where('user_id', $alumno->id)
                ->where('curso_id', $curso->id)
                ->first();
                if($inscription != null) {
                    try{
                        $certificate = $this->msCertValidationClient->createCert(
                            CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, $lastCertificateNumber, "2")
                        )->response;
                        $lastCertificateNumber++;
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

        Utils::saveSetting('last_certificate_number', $lastCertificateNumber);

        return $result;
    }
}
