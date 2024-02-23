<?php
namespace App\Traits;

use MercadoPago;
use App\Helpers\Utils;

trait MercadopagoIntegration {

    public function getPaymentById($payment_id)
    {
		$AUTHORIZATION = "authorization: Bearer " . config('services.mercadopago.token');
		$CAHCE_CONTROL = "cache-control: no-cache";
    	$API_MP = config('services.mercadopago.api_url');
        $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "$API_MP/payments/$payment_id",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			$AUTHORIZATION,
		    $CAHCE_CONTROL
		  ),
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);
		curl_close($curl);

		$array = json_decode($response, true);

		if ($error) {
		 throw $error;
		} else {
		  return $array;
		}
    }

    public function createPreferenceMP($inscription, $curso, $user)
    {
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        
		$preference = new MercadoPago\Preference();

        $item = new MercadoPago\Item();
        $item->id = $inscription->id;
        $item->title = $curso->titulo;
        $item->quantity = 1;
        $item->unit_price = Utils::formatPrice($curso->unit_price);

        $payer = new MercadoPago\Payer();
        $payer->email = 'TEST_USER_538885045';

        $preference->items = array($item);
        $preference->payer = $payer;
        $preference->save();

        return $preference;
    }

}