<?php

namespace App\Http\Controllers;

use App\Curso;
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
use App\Filters\PaymentsFilter;

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
                'amount' =>$item->getPrice(),
                'status' => $result->getState(),
                'gateway' => 'PAYPAL',
                'payload' => json_encode($result),
                'payment_date' => $result->getCreateTime(),
            ]);
        }catch(Exception $ex){
            Log::error('PAYPAL:::Error al registrar pago: ' . $result->getId(), ['errorMessage' => $ex->getMessage()]);
        }

        return;
    }

    function payments(Request $request )
    {
        $paymentFilter = new PaymentsFilter($request);

        $payments = InscriptionPayment::filter($paymentFilter)
            ->orderBy('created_at', 'DESC')
            ->paginate(15)
            ->appends($paymentFilter->request->query());

        return view('admin.payments.index', compact('payments'));
    }

    public function paymentDetails(Request $request, $paymentId)
    {

        $insPayment = InscriptionPayment::where('payment_identifier', $paymentId)->firstOrFail();

        $paymentDetails = [];
        if($insPayment->gateway === MPIntegrationConstants::MP_GATEWAY_NAME)
            $paymentDetails = $this->handleMercadopagoDataPayment($insPayment);

        if($insPayment->gateway === PaypalIntegrationConstants::PP_GATEWAY_NAME)
            $paymentDetails = $this->handlePaypalDataPayment($insPayment);


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
            'dateApprobed' => null,
            'status' => $payment->status,
            'netReceivedAmount' => $payment->transaction_details['net_received_amount'],
            'totalAmount' => $payment->transaction_amount,
            'description' => $payment->additional_info['items'][0]['title'],
            'items' => (object) [
                (object) [
                    'itemDetail' => $payment->additional_info['items'][0]['title'],
                    'itemUnitPrice' => $payment->additional_info['items'][0]['unit_price'],
                    'itemCurrency' => '',
                    'itemQuantity' => '',
                ]
            ],
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
        $payment = $this->paypalService->getPayment($insPayment->payment_identifier);

        //dd($payment);

        $paymentDetails = [
            'inscription' => (object) [
                'alumno' => (object) [
                    'fullName' => $insPayment->inscription->alumno->fullName(),
                    'email' => $insPayment->inscription->alumno->email,
                ]
            ],
            'identifier' => $payment->getId(),
            'dateCreated' => $payment->getCreateTime(),
            'dateApprobed' => $payment->date_approved,
            'status' => $payment->status,
            'description' => $payment->getTransactions()[0]->getDescription(),
            'items' => (object) [
                (object) [
                    'itemDetail' => $payment->getTransactions()[0]->getItemList()->getItems()[0]->getName(),
                    'itemUnitPrice' => $payment->getTransactions()[0]->getItemList()->getItems()[0]->getPrice(),
                    'itemCurrency' => $payment->getTransactions()[0]->getItemList()->getItems()[0]->getCurrency(),
                    'itemQuantity' => $payment->getTransactions()[0]->getItemList()->getItems()[0]->getQuantity(),
                ]
            ],
            'gateway' => '$insPayment->gateway',
        ];
        return (object) $paymentDetails;
    }

    function syncAmountsMP(Curso $curso)  {

        $inscripciones = $curso->inscripciones()
            ->where('estado_del_pago', '!=', 'Pendiente')
            ->with('payments')
            ->get();

        foreach ($inscripciones as $i) {
            $payments = $i->payments()->get();
            foreach ($payments as $p) {
                if($p->net_received_amount == null) {
                    $paymentResponse = $this->mercadopagoService->getPaymentById($p->payment_identifier);
                    $p->net_received_amount = $paymentResponse['transaction_details']['net_received_amount'];
                    $p->save();
                }
            }
        }
    }
}
