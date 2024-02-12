<?php

namespace App\Http\Controllers;

use Exception;
use App\Inscripcion;
use GuzzleHttp\Client;
use App\InscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\MercadopagoIntegration;
use App\Constants\MPIntegrationConstants;
use App\Repositories\InscriptionRepository;

class WebHooksMercadoPagoController extends Controller
{
	use MercadopagoIntegration;

	private $inscriptionRepository;

	public function __construct(InscriptionRepository $inscriptionRepository) 
    {
        $this->inscriptionRepository = $inscriptionRepository;
    }

	public function webhookMp(Request $request)
	{
		try {
			$payment_id = $request->data['id'];     

			Log::info('WEBHOOK_MP:::PagoRecibido');     
			Log::info('WEBHOOK_MP:::PaymentId: ' . $payment_id);     
			
			Log::info('WEBHOOK_MP:::BuscandoPagoPorID');     
			$paymentResponse = $this->getPaymentById($payment_id);
			
			$item = $paymentResponse['additional_info']['items'][0];
			$inscription = $this->inscriptionRepository->getInscriptionById($item['id']);
			
			if (InscriptionPayment::where('payment_identifier', $payment_id)->count() == 0) {				
				Log::info('WEBHOOK_MP:::RegistrandoPago');
				$payment = InscriptionPayment::create([
					'inscription_id' => $inscription->id,
					'user_id' => $inscription->user_id,
					'payment_identifier' => $payment_id,
					'amount' =>$paymentResponse['transaction_amount'],
					'status' =>$paymentResponse['status'],
					'gateway' => 'MERCADOPAGO',
					'payload' => json_encode($request->data),
					'payment_date' => $paymentResponse['date_created']
				]);

				Log::info('WEBHOOK_MP:::ActualizandoInscripcion');     
				$inscription = $this->updateInscriptionStatus($inscription, $paymentResponse);
				
				Log::info('WEBHOOK_MP:::PaymentProcessed: ' . $paymentResponse['status']);
			} else {
				Log::info('WEBHOOK_MP:::ElPagoYaExiste');     
			}
			return response()->json(['success' => 'success'], 200);

		} catch (Exception $e) {

			Log::error('WEBHOOK_MP:::ERROR: ' . $e);
			return response()->json(['error' => 'error'], 500);

		}

		
	}

	private function updateInscriptionStatus($inscription, $paymentResponse)
	{
		if ($paymentResponse['status'] == MPIntegrationConstants::PAYMENT_STATUS_APPROVED ) {
			$amountPaid = $inscription->getAmountPaid();
			$amountPaid >= $inscription->curso->unit_price
				? $inscription->estado_del_pago = Inscripcion::PAGADO
				: $inscription->estado_del_pago = Inscripcion::PAGADO_PARCIAL;
			$inscription->update();
		}

		return $inscription;
	}

	public function webhookMpTest(Request $request)
	{

		try {
			$payment_id = $request->data['id'];     
	
			Log::info('WEBHOOK_MP:::PagoRecibido');     
			Log::info('WEBHOOK_MP:::PaymentId: ' . $payment_id);     
	
			$paymentResponse = $this->getPaymentById($payment_id);
	
			Log::info('WEBHOOK_MP:::PaymentStatus: ' . $paymentResponse['status']); 
	
			return response()->json(['success' => 'success'], 200);
		} catch (Exception $e) {
			Log::error('WEBHOOK_MP:::ERROR: ' . $e);
			return response()->json(['error' => 'error'], 500);
		}

	}
}