<?php

namespace App\Http\Controllers;

use App\Curso;
use Carbon\Carbon;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\Mail\SuccessfulInscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\CursoRepositoryInterface;
use App\Interfaces\InscriptionRepositoryInterface;
use App\Interfaces\MercadoPagoIntegrationInterface;

class InscripcionController extends Controller
{

    private $cursoRepository;
    private $mercadopagoService;
    private $inscriptionRepository;

	public function __construct(
        CursoRepositoryInterface $cursoRepository, 
        InscriptionRepositoryInterface $inscriptionRepository,
        MercadoPagoIntegrationInterface $mercadopagoService){

        $this->cursoRepository = $cursoRepository;
        $this->inscriptionRepository = $inscriptionRepository;
        $this->mercadopagoService = $mercadopagoService;

    }

    /**
     * BACK
     */

    // $token es el token del curso.
    // la $request debe venir de mercado pago o paypal
    public function verificarPago(Request $request, $token)
    {
        $curso = Curso::where('token', $token)->first();

        $user = Auth::user();

        $inscription = Inscripcion::where('user_id', $user->id)
                                    ->where('curso_id', $curso->id)
                                    ->first();
        if ($inscription) {
            $this->registrarPago($inscription, $user);
            
            return view('sitio.inscripcion.pago-registrado');
        }else{
            return 'Ups algo salió mal. :(';
        }

    }


    public function updatePago(Request $request)
    {
        $inscription = Inscripcion::find($request->id);
        $inscription->estado_del_pago = $request->pago;

        if ($request->pago == Inscripcion::PAGADO) {
            $inscription->fecha_del_pago = Carbon::now();
        }else{
            $inscription->fecha_del_pago = null;
        }

        $inscription->update();

        // preparo la isncripcion para madarla a la vista e imprimirla
        $inscription = Inscripcion::find($request->id);
        $inscription->alumno =  $inscription->alumno()->first();

        if($inscription->estado_del_pago == Inscripcion::PAGADO){
            $inscription->estado_del_pago = '<span class="badge badge-pill badge-success">'.$inscription->estado_del_pago.'</span>';
            $inscription->fecha_del_pago = date('Y-m-d H:i', strtotime($inscription->fecha_del_pago));
        }
        
        if($inscription->estado_del_pago == Inscripcion::PENDIENTE){
            $inscription->estado_del_pago = '<span class="badge badge-pill badge-warning">'.$inscription->estado_del_pago.'</span>';
            $inscription->fecha_del_pago = '-';
        }
        
        return $inscription;
    }

    private function registrarPago($inscription, $user)
    {
        Log::info('WEBHOOK_PAYP:::RegistrandoPago');     
        $inscription->estado_del_pago = Inscripcion::PAGADO;
        $inscription->fecha_del_pago = Carbon::now();
        $inscription->update();
        Log::info('WEBHOOK_PAYP:::PagoRegistrado - UserID: ' . $user->id);     

        return;
    }

    public function eliminarInscripcion(Request $request)
    {
        $inscripcion = Inscripcion::findOrFail($request->id);
        $inscripcion->delete();

        return;
    }

    public function paymentDetails(Request $request, $paymentId)
    {

        $paymentResponse = $this->mercadopagoService->getPaymentById($paymentId);
        $payment = (Object) $paymentResponse;

        $inscription = $this->inscriptionRepository->getInscriptionById($payment->additional_info['items'][0]['id']);
        $student = $inscription->alumno()->first();
        
        $payment->student = $student;


        return view('admin.inscriptions.payment-details', compact('payment'));
    }


    /**
     * FRONT
     */

    public function crearInscripcion(Request $request)
    {
        $user = Auth::user();
        $canal = $request->canal; 
        $curso = $this->cursoRepository->findOrFailById($request->curso_id); 
        
        if (!$user->estaInscriptoEn($curso->id)){
            //no registra inscripcion => Inscribir
            $this->inscriptionRepository->saveInscription($user->id, $curso->id, $canal);
    
            Mail::to($user->email)->send(new SuccessfulInscription($curso, $user));
        }            
          
        return redirect()->route('curso_step_inscription_payment', $curso->slug);
             
    }

    public function inscription(Request $request, $slug)
    {     
        $user = Auth::user();
        
        $curso = $this->cursoRepository->getCursoBySlug($slug);
        
        if($user->estaInscriptoEn($curso->id)){
            return redirect()->route('curso_step_inscription_payment', $curso->slug);
        }
        
        return view('sitio.inscripcion.index', compact('curso'));
    }

    public function inscriptionPayment(Request $request, $slug)
    {
        $user = Auth::user();
        
        $curso = $this->cursoRepository->getCursoBySlug($slug);
        $cursoFee = $this->cursoRepository->getCursoBySlug($slug);
        
        if(!$user->estaInscriptoEn($curso->id)){
            return redirect()->route('curso_inscription', $curso->slug);
        }
        
        $inscription = $this->inscriptionRepository->findInscriptionByUserIdCursoId($curso->id, $user->id); 
        
        if ( $inscription->pagado() ) {
            return view('sitio.inscripcion.payment-status', compact('curso', 'inscription', 'user'));
        }

        //PAGO TOTAl
        $preference = $this->mercadopagoService->createPreferenceMP($inscription, $curso, $user);

        //PAGO EN 2 CUOTAS
        $cursoFee->unit_price = ($curso->unit_price + $curso->unit_price * config('custom.payments.course_fee_tax')) / 2;
        $preferenceFee = $this->mercadopagoService->createPreferenceMP($inscription, $cursoFee, $user);
        
        return view('sitio.inscripcion.payment', compact('curso', 'cursoFee', 'preference', 'preferenceFee', 'inscription'));
    }

    public function show(Request $request, Inscripcion $inscription)
    {
        return view('admin.inscriptions.show', compact('inscription'));
    }
}
