<?php

namespace App\RestClients;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class MSCertValidation
{

    private $baseUrl;
    private $httpClient;

    function __construct()
    {
        $this->httpClient = new Client();
        $this->baseUrl = config('services.ms_cert_validation.api_url');
    }

    public function getCertificates() {
        Log::info("MSCertValidation::getCertificates ...");
        $response = $this->httpClient->request('GET', $this->baseUrl . '/api/v1/certificates');
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    } 
    
    public function getCertificateDetails($idCertificate) {
        Log::info("MSCertValidation::getCertificateDetails...");
        $response = $this->httpClient->request('GET', $this->baseUrl . '/api/v1/certificates/' . $idCertificate);
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    public function deleteCertificate($idCertificate) {
        Log::info("MSCertValidation::getCertificateDetails...");
        $response = $this->httpClient->request('DELETE', $this->baseUrl . '/api/v1/certificates/' . $idCertificate);
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    public function createCert($msRequest) {
        Log::info("MSCertValidation::createCert... ");
        $response = $this->httpClient->request('POST', $this->baseUrl . '/api/v1/certificates', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer TU_TOKEN'
            ],
            'json' => $msRequest
        ]);
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    function login(): string {
        $headers = [
            'User-Agent' => 'testing/1.0',
            'Accept'     => 'application/json',
            'X-Foo'      => ['Bar', 'Baz']
        ];
        $bodyRequest = [
            'username' => 'abc',
            'password' => '123'
        ];

        $response = $this->httpClient->request('POST', $this->baseUrl . '/posts',[ 
            'headers' => $headers,
            'body' => $bodyRequest
        ]);

        if ($response->getStatusCode() === 200) {
            return $response->getBody();
        }
    }
}
