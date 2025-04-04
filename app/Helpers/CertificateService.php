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
        $urlQueryParams = request()->getQueryString();
        $query = [];

        foreach (request()->query() as $key => $value) {
            $query[$key] = $value;
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
        $msRequest = CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, $request->certificado_numero, $request->tf_certificado_numero);

        $certificate = $this->msCertValidationClient->createCert($msRequest)->response;

        $inscripcion->ms_certificate_id = $certificate->uuid;
        $inscripcion->save();

        return $certificate;
    }
}
