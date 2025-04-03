<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\Request;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Cache;

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
}
