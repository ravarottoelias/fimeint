<?php

declare(strict_types=1);

namespace App\Helpers;

use App\User;
use App\Curso;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CertificateStoreRequest;

class CertificateService
{
    private $msCertValidationClient;

    function __construct(MSCertValidation $msCertValidationClient) {
        $this->msCertValidationClient = $msCertValidationClient;
    }

    public function getCachedCertificateDetails($uuid) {
        $certificate = Cache::get('cert_'.$uuid);

        if ($certificate) {
            return $certificate;
        } 

        $certificate = $this->msCertValidationClient->getCertificateDetails($uuid)->response;
        
        Cache::put('cert_'.$uuid, $certificate, 60*27);

        return $certificate;
    }

    public function getCachedCetificates(Request $request) {
        $urlQueryParams = null;
        $query = [];
        foreach ($request->query() as $key => $value) {
            $query[$key] = $value;
            $urlQueryParams = $urlQueryParams . "$key=$value&";
        }
 
        $certificates = Cache::remember("certificates_page_{$urlQueryParams}", now()->addMinutes(60*12), function () use ($query){
            return $this->msCertValidationClient->getCertificates($query)->response;
        });

        return $certificates;
    }

    public function deleteCert($uuid) 
    {
        $certificate = $this->getCachedCertificateDetails($uuid);

        $response = $this->msCertValidationClient->deleteCertificate($certificate->id)->response;

        $inscription = Inscripcion::where('ms_certificate_id', $certificate->id)
                ->first();
        $inscription->ms_certificate_id = null;
        $inscription->save();

        return $response;
    }

    public function createCert(CertificateStoreRequest $request)
    {
        $inscripcion = Inscripcion::findOrFail($request->inscripcion_id);
        $alumno = User::find($inscripcion->user_id);
        $curso = Curso::find($inscripcion->curso_id);

        $lastCertificateNumber = Utils::getSetting('last_certificate_number');
        
        $tomo_folio = $this->calculateTomoFolio($curso);
                
        $msRequest = CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, $lastCertificateNumber, $tomo_folio);
        $certificate = $this->msCertValidationClient->createCert($msRequest)->response;

        $inscripcion->ms_certificate_id = $certificate->uuid;
        $inscripcion->save();

        return $certificate;
    }

    public function calculateTomoFolio(Curso $curso) {
        $lastCertificateLineNumber = $curso->inscripciones()->where('ms_certificate_id', '!=', null)->count();
        $lastCertificateTomo = Utils::getSetting('last_certificate_tomo');
        $quantityFolioPorTomo = Utils::getSetting('quantity_folio_por_tomo');
        $lastCertificateFolio1 = Utils::getSetting('last_certificate_folio');
        $lastCertificateFolio2 = $lastCertificateFolio1 + 1;
        
        //Avanzar tomo
        if($lastCertificateFolio1 > $quantityFolioPorTomo || $lastCertificateFolio2 > $quantityFolioPorTomo){
            $lastCertificateLineNumber = 0;
            $lastCertificateTomo++;
            $lastCertificateFolio1 = 1;
            $lastCertificateFolio2 = 2;
        }

        //Avanzar folios
        if ($lastCertificateLineNumber < 15){
            $folio = "$lastCertificateFolio1 y $lastCertificateFolio2";
        } else {   
            $lastCertificateLineNumber = $lastCertificateLineNumber - 15;
            while ($lastCertificateLineNumber > 30) {
                $lastCertificateLineNumber = $lastCertificateLineNumber - 30;
            } 
            if($lastCertificateLineNumber == 30) {
                $lastCertificateFolio1 = $lastCertificateFolio1 + 2;
                $lastCertificateFolio2 = $lastCertificateFolio1 + 1;  
            }

            $folio = "$lastCertificateFolio1 y $lastCertificateFolio2";
        }
        $tomo_folio = "T: $lastCertificateTomo. F: $folio";

        return $tomo_folio;
    }
}
