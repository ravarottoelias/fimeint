<?php

declare(strict_types=1);

namespace App\Helpers;

use App\User;
use stdClass;
use App\Curso;
use Exception;
use App\Inscripcion;
use Illuminate\Support\Facades\Log;
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
        $quantityFolioPorTomo = Utils::getSetting('quantity_folio_por_tomo');
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
                        $tomo_folio = "T: $lastCertificateTomo. F: $lastCertificateFolio";
                        $certificate = $this->msCertValidationClient->createCert(
                            CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, $lastCertificateNumber, $tomo_folio)
                        )->response;
                        $lastCertificateNumber++;
                        $lastCertificateFolio++;
                        if($lastCertificateFolio > $quantityFolioPorTomo){
                            $lastCertificateFolio = 1;
                            $lastCertificateTomo++;
                        }
                        $inscription->ms_certificate_id = $certificate->id;
                        $inscription->save();
                        array_push($result->success,$element->dni . ' - ' . $element->nombre . '. Certificado creado.');
                    } catch (Exception $ex) {
                        Log::error("GenerateMassiveCertificates() error al crear certificado. Usuario: $element->nombre - ". $ex->getMessage());
                        array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se pudo crear el certificado.');
                    }
                } else {
                    Log::error("GenerateMassiveCertificates() no se encontró inscripción para el Usuario: $element->nombre");
                    array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se encontró inscripción al curso.');
                }
            } else {
                Log::error("GenerateMassiveCertificates() no se encontró el Usuario: $element->nombre");
                array_push($result->fails, $element->dni . ' - ' . $element->nombre . '. No se encontró alumno.');
            }
        }

        Utils::saveSetting('last_certificate_number', $lastCertificateNumber);
        Utils::saveSetting('last_certificate_tomo', $lastCertificateTomo);
        Utils::saveSetting('last_certificate_folio', $lastCertificateFolio);

        return $result;
    }
}
