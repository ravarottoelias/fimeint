<?php

namespace App\Interfaces;

interface MercadoPagoIntegrationInterface 
{
    public function getPaymentById($paymentId);
    public function createPreferenceMP($inscription, $curso, $user);
}