<?php

namespace App\Http\Controllers;

use Exception;
use App\Inscripcion;
use App\Helpers\Utils;
use App\InscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PaypalIntegration;
use App\Constants\MPIntegrationConstants;
use App\Repositories\InscriptionRepository;
use App\Repositories\MercadoPagoIntegration;
use App\Constants\PaypalIntegrationConstants;

class InscriptionPaymentController extends Controller
{

    private $mercadopagoService;
    private $inscriptionRepository;
    private $paypalService;

	public function __construct(
        InscriptionRepository $inscriptionRepository,
        MercadoPagoIntegration $mercadopagoService,
        PaypalIntegration $paypalService){

        $this->inscriptionRepository = $inscriptionRepository;
        $this->mercadopagoService = $mercadopagoService;
        $this->paypalService = $paypalService;

    }


    /**
     * This method creates the payment preference and redirects the user to PayPal.
     *
     * @return RedirectResponse
     */
    function payWithPaypal(Request $request, Inscripcion $inscription) : RedirectResponse
    {
        $curso = $inscription->curso;
        $data = [];
        if($request->get('paymentType') === 'fee'){
            //Pago en 2 cuotas
            $data = [
                'description' => 'Inscripción al curso: ' . $curso->titulo,
                'total' => Utils::formatPrice($curso->calcularValorCuota()),
                'returnUrl' => route('inscript_paypal_execute_payment'),
                'cancelUrl' => route('inscript_paypal_execute_payment'),
                'itemList' => [
                    (object)[
                        'sku' => $inscription->id,
                        'itemName' => 'Pago cuota de inscipción.',
                        'itemQuantity' => 1,
                        'itemPrice' => Utils::formatPrice($curso->calcularValorCuota()),
                    ]
                ],

            ];
        } else {
            $data = [
                'description' => 'Inscripción al curso: ' . $curso->titulo,
                'total' => Utils::formatPrice($curso->unit_price),
                'returnUrl' => route('inscript_paypal_execute_payment'),
                'cancelUrl' => route('inscript_paypal_execute_payment'),
                'itemList' => [
                    (object)[
                        'sku' => $inscription->id,
                        'itemName' => 'Pago total de inscripción.',
                        'itemQuantity' => 1,
                        'itemPrice' => Utils::formatPrice($curso->unit_price),
                    ]
                ]
            ];
        }

        return $this->paypalService->makePayment((object) $data);
        
    }

    /**
     * This method receives the ID of the created payment and executes it
     *
     * @param Request $request
     * @return RedirectResponse
     */
    function paypalExecutePayment(Request $request) : RedirectResponse
    {      
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');
        
        $successFulMessage = 'Pago Exitoso. Su pago fué registrado correctamente.';
        $errorMessage = 'Pago Fallido. Lo sentimos algo salió mal al realizar el pago.';
        
        if(!$payerId || !$paymentId || !$token)
            return redirect()->back()->with('error', $errorMessage );
        
        $result = $this->paypalService->executePayment($paymentId, $payerId);
        $item = $result->getTransactions()[0]->getItemList()->getItems()[0];

        # actualizar inscripcion
        $inscription = $this->inscriptionRepository->getInscriptionById($item->sku); 
        $this->inscriptionRepository->updateInscriptionStatus( $inscription,['status' => $result->getState()]);

        # registrar pago en DB.
        $this->handleStorePayment($inscription, $item, $result);

        if ($result->getState() === PaypalIntegrationConstants::PP_PAYMENT_STATUS_APPROVED) {                     
            return redirect()
                    ->route('curso_step_inscription_payment', [$inscription->curso->slug])
                    ->with('success', $successFulMessage);
        }
        
        return redirect()
                    ->back()
                    ->with('error', $errorMessage);
        
    }

    /**
     * This method stores the payment in database
     *
     * @param [type] $inscription
     * @param [type] $item
     * @param [type] $result
     * @return void
     */
    private function handleStorePayment($inscription, $item, $result)
    {
        try{
            Log::info('PAYPAL:::RegistrandoPago');
            $payment = InscriptionPayment::create([
                'inscription_id' => $inscription->id,
                'user_id' => $inscription->user_id,
                'payment_identifier' => $result->getId(),
                //'amount' =>$item->getPrice(),
                'status' => $result->getState(),
                'gateway' => 'PAYPAL',
                'payload' => json_encode($result),
                'payment_date' => $result->getCreateTime(),
            ]);
        }catch(Exception $ex){
            Log::error('PAYPAL:::Error al registrar pago: ' . $result->getId(), $ex);
        }

        return;
    }

    function payments(Request $request)
    {
        $payments = InscriptionPayment::orderBy('created_at', 'DESC')->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    public function paymentDetails(Request $request, $paymentId)
    {

        $insPayment = InscriptionPayment::where('payment_identifier', $paymentId)->firstOrFail();

        $paymentDetails = [];
        if($insPayment->gateway === MPIntegrationConstants::MP_GATEWAY_NAME)
            $paymentDetails = $this->handleMercadopagoDataPayment($insPayment);

        if($insPayment->gateway === PaypalIntegrationConstants::PP_GATEWAY_NAME)
            $paymentDetails = $this->handlePaypalDataPayment();


        return view('admin.inscriptions.payment-details', compact('paymentDetails', 'insPayment'));
    }

    /**
     * This method obtains the payment data using the Mercadopago integration
     *
     * @param InscriptionPayment $insPayment
     * @return object
     */
    private function handleMercadopagoDataPayment(InscriptionPayment $insPayment) : object
    {
        $paymentResponse = $this->mercadopagoService->getPaymentById($insPayment->payment_identifier);
        $payment = (Object) $paymentResponse;

        $paymentDetails = [
            'inscription' => (object) [
                'alumno' => (object) [
                    'fullName' => $insPayment->inscription->alumno->fullName(),
                    'email' => $insPayment->inscription->alumno->email,
                ]
            ],
            'identifier' => $payment->id,
            'dateCreated' => $payment->date_created,
            'dateApprobed' => $payment->date_approved,
            'status' => $payment->status,
            'itemDetail' => $payment->additional_info['items'][0]['title'],
            'itemUnitPrice' => $payment->additional_info['items'][0]['unit_price'],
            'gateway' => $insPayment->gateway,
        ];
        return (object) $paymentDetails;
    }
    
    /**
     * This method obtains the payment data using the Paypal integration
     *
     * @param InscriptionPayment $insPayment
     * @return object
     */
    private function handlePaypalDataPayment(InscriptionPayment $insPayment) : object
    {
        
    }
}
