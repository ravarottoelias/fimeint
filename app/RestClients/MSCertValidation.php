<?php

namespace App\RestClients;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ClientException;


class MSCertValidation
{

    private $baseUrl;
    private $httpClient;
    private $userEmail;
    private $userPassword;

    function __construct()
    {
        $this->httpClient = new Client();
        $this->baseUrl = config('services.ms_cert_validation.api_url');
        $this->userEmail = config('services.ms_cert_validation.user_email');
        $this->userPassword = config('services.ms_cert_validation.user_password');
        $this->getCachedToken();
    }

    public function getCertificates(array $query = []) {
        Log::info("MSCertValidation::getCertificates ...");
        $token = Cache::get('api_ms_token');
        $response = $this->httpClient->request(
            'GET', 
            $this->baseUrl . '/api/v1/certificates',
            [
                'query' => $query,
                'headers' => [
                    'Authorization' => "Bearer $token",
                    'Accept' => 'application/json',
                ], 
            ]
        );
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    } 
    
    public function getCertificateDetails($uuid) {
        Log::info("MSCertValidation::getCertificateDetails...");
        $token = Cache::get('api_ms_token');
        $response = $this->httpClient->request(
            'GET', 
            $this->baseUrl . '/api/v1/certificates/' . $uuid,
            [
                'headers' => [
                    'Authorization' => "Bearer $token",
                    'Accept' => 'application/json',
                ], 
            ]
        );
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    public function deleteCertificate($idCertificate) {
        Log::info("MSCertValidation::getCertificateDetails...");
        $token = Cache::get('api_ms_token');
        $response = $this->httpClient->request(
            'DELETE', 
            $this->baseUrl . '/api/v1/certificates/' . $idCertificate,
            [
                'headers' => [
                    'Authorization' => "Bearer $token",
                    'Accept' => 'application/json',
                ], 
            ]
        );
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    public function createCert($msRequest) {
        Log::info("MSCertValidation::createCert... ");
        $token = Cache::get('api_ms_token');
        $response = $this->httpClient->request('POST', $this->baseUrl . '/api/v1/certificates', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $token"
            ],
            'json' => $msRequest
        ]);
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }

    public function login() {
        Log::info("MSCertValidation::login... user: $this->userEmail , pass: $this->userPassword");
        $headers = [
            'Accept'     => 'application/json',
        ];
        $bodyRequest = [
            'email' => $this->userEmail,
            'password' => $this->userPassword
        ];

        $response = $this->httpClient->request('POST', $this->baseUrl . '/api/v1/login',[ 
            'headers' => $headers,
            'form_params' => $bodyRequest
        ]);

        if ($response->getStatusCode() === 200) {
            $body = json_decode($response->getBody());
            return $body;
        }

        return null;
    }

    public function getCachedToken() {
        $token = Cache::get('api_ms_token');

        if ($token) {
            return $token;
        } 

        $res = null;
        try{
            $res = $this->login();
            $token = $res->response->plainTextToken;
            Cache::put('api_ms_token', $token, 60*27);
            return $token;
        } catch (ClientException  $ex){
            Log::error("MSCertValidation::getCachedToken: error al intentar loguearse");
        }

        return null;

    }
}
