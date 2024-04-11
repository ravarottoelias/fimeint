<?php

namespace App\Constants;

class MPIntegrationConstants {

   const MP_GATEWAY_NAME = 'MERCADOPAGO';
   const PAYMENT_STATUS_APPROVED = 'approved';
   const PAYMENT_STATUS_REJECTED = 'rejected';

   const PREFERENCE_BACKS_URLS = array(
      "success" => "",
      "failure" => "",
      "pending" => "",
   );

   
}