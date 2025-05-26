<?php

namespace App\Http\Controllers;

use App\Constants\MPIntegrationConstants;
use Exception;
use App\InscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\InscriptionRepository;
use App\Repositories\MercadoPagoIntegration as RepositoriesMercadoPagoIntegration;

class WebHooksMercadoPagoController extends Controller
{
	private $inscriptionRepository;
	private $mercadoPagoIntegration;

	public function __construct(InscriptionRepository $inscriptionRepository, RepositoriesMercadoPagoIntegration $mercadoPagoIntegration) 
    {
        $this->inscriptionRepository = $inscriptionRepository;
        $this->mercadoPagoIntegration = $mercadoPagoIntegration;
    }

	public function webhookMp(Request $request)
	{
		try {
			$payment_id = $request->data['id'];     

			Log::info('WEBHOOK_MP:::PagoRecibido');     
			Log::info('WEBHOOK_MP:::PaymentId: ' . $payment_id);     
			Log::info('WEBHOOK_MP:::BuscandoPagoPorID: ' . $payment_id);     
			$paymentResponse = $this->mercadoPagoIntegration->getPaymentById($payment_id);
			
			$item = $paymentResponse['additional_info']['items'][0];
			$inscription = $this->inscriptionRepository->getInscriptionById($item['id']);

			if($paymentResponse['status'] != MPIntegrationConstants::PAYMENT_STATUS_APPROVED){
				Log::info('WEBHOOK_MP:::PagoNOAprobado: ' . $payment_id . ' ' . $paymentResponse['status']);
				return response()->json(['success' => 'success'], 200);
			}
			
			if (InscriptionPayment::where('payment_identifier', $payment_id)->where('status', $paymentResponse['status'] )->count() == 0) {				
				Log::info('WEBHOOK_MP:::RegistrandoPago: ' . $payment_id);
				$netReceivedAmount = null;
				try {
					$netReceivedAmount = $paymentResponse['transaction_details']['net_received_amount'];
				} catch (\Throwable $th) {
					Log::error('WEBHOOK_MP:::Error al leer montos: ' . $payment_id);
				}
				$payment = InscriptionPayment::create([
					'inscription_id' => $inscription->id,
					'user_id' => $inscription->user_id,
					'payment_identifier' => $payment_id,
					'amount' =>$paymentResponse['transaction_amount'],
					'net_received_amount' =>$netReceivedAmount,
					'status' => $paymentResponse['status'],
					'gateway' => 'MERCADOPAGO',
					'payload' => json_encode($paymentResponse),
					'payment_date' => $paymentResponse['date_created']
				]);

				Log::info('WEBHOOK_MP:::ActualizandoInscripcion');     
				$inscription = $this->inscriptionRepository->updateInscriptionStatus($inscription, $paymentResponse);
				
				Log::info('WEBHOOK_MP:::PaymentProcessed: ' . $payment_id . ' ' . $paymentResponse['status']);
			} else {
				Log::info('WEBHOOK_MP:::ElPagoYaExiste: ' . $payment_id);     
			}
			return response()->json(['success' => 'success'], 200);

		} catch (Exception $e) {

			Log::error('WEBHOOK_MP:::ERROR: ' . $e);
			return response()->json(['error' => 'error'], 500);

		}

		
	}
}