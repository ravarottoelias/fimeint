<?php

namespace App\Http\Controllers;

use App\User;
use App\Curso;
use Exception;
use App\Inscripcion;
use App\Helpers\Utils;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\CertificateService;
use App\Helpers\CertificatesHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\ClientException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\CertificateStoreRequest;

class CertificatesController extends Controller
{

    private $certificateService;
    private $certificatesHelper;

    public function __construct(CertificatesHelper $certificatesHelper, CertificateService $certificateService) {
        $this->certificatesHelper = $certificatesHelper;
        $this->certificateService = $certificateService;
    }

    function index(Request $request) : View {
        try {
            $certificates = $this->certificateService->getCachedCetificates($request);
            $certificates = $this->certificatesHelper->buildResponseCertificates($certificates);
            return view('admin.certificates.index', compact('certificates'));
        } catch (\Throwable $ex) {
            Log::error("Error al obtener certificados: " . $ex->getMessage());
            $certificates = [];
            Session::flash('error', "Error al obtener certificados. " . $ex->getMessage()); 
            return view('admin.certificates.index', compact('certificates'));
        }
        
    }

    function show($uuid) : View {
        try {
            $certificate = $this->certificateService->getCachedCertificateDetails($uuid);
            $qrDecoded = config('services.ms_cert_validation.app_cert_validation_url') . "?version=1&qr=$certificate->codigoQr";
            
            $qrcode = Cache::remember("qr_cert_{$uuid}", now()->addMinutes(60*12), function () use ($qrDecoded){    
                $qr = QrCode::format('png')->size(300)->format('png')->generate($qrDecoded);
                return base64_encode($qr);
            });

            $inscription = null;
            try{
                $inscription = Inscripcion::where('curso_id', $certificate->cursoId)->where('user_id', $certificate->alumnoId)->first();
            } catch(Exception $ex) {
                Log::error("Error al buscar inscripcion. Certificado ID: " . $certificate->id, $ex);
            }
            return view('admin.certificates.show', compact('certificate', 'qrcode', 'qrDecoded', 'inscription'));

        } catch (Exception $ex) {
            Log::error("Error al obtener el certificado: " . $ex->getMessage());
            if($ex instanceof ClientException){
                $errorCode = $ex->getCode();
                $errorMessage = $ex->getMessage();
            } else {
                $errorCode = 500;
                $errorMessage = $ex->getMessage();
            }
            return view('admin.errorpage', compact('errorCode', 'errorMessage'));
            
        }
    }

    function deleteCert($uuid) {
        try {
            $this->certificateService->deleteCert($uuid);
            Cache::flush();
            Session::flash('success', "El certificado fué eliminado correctamente."); 
            return redirect()->route('certificates');
        } catch (\Throwable $ex) {
            Log::error("Error al eliminar certificados: " . $ex->getMessage());
            Session::flash('error', "Error al eliminar el certificado. " . $ex->getMessage()); 
            return Redirect::back();
        }
    }

    function createStepOne() : View {
        return view('admin.certificates.create-step-one');
    }

    function createStepTwo(Request $request) : View {
        $inscripcion = Inscripcion::findOrFail($request->inscripcionId);
        $alumno = User::find($inscripcion->user_id);
        $curso = Curso::find($inscripcion->curso_id);
        $certificado_nro = Utils::getSetting('last_certificate_number');
        $tomo = Utils::getSetting('last_certificate_tomo');
        $folio = Utils::getSetting('last_certificate_folio');
        $tomo_folio = "T: $tomo. F: $folio";
        return view('admin.certificates.create-step-two', compact('inscripcion', 'alumno', 'curso', 'certificado_nro', 'tomo_folio'));
    }

    function store(CertificateStoreRequest $request) {
        try{
            $certificate = $this->certificateService->createCert($request);            
            Cache::flush();
            Session::flash('success', "El certificado se creó correctamente."); 
            return Redirect::route('certificates_show', $certificate->uuid); 
        } 
        catch (ClientException $ex){
            if($ex->getResponse()->getStatusCode() == Response::HTTP_BAD_REQUEST){
                $apiErrors = json_decode($ex->getResponse()->getBody()->getContents(), true);     
                Session::flash('apiErrors', $apiErrors['errors']); 
                return redirect()->back();
            }
            Log::error('Error al crear el certificado: ' . $ex->getMessage());
            Session::flash('error', "Error al crear el certificado. " . $ex->getMessage()); 
            return Redirect::back();
        } 
        catch(Exception $ex) {
            Session::flash('error', "Error al crear el certificado. Detalles en el log." . $ex->getMessage()); 
            return Redirect::back();
        }
    }

    
    public function generatePDF($uuid) 
    {
        $cert = $this->certificateService->getCachedCertificateDetails($uuid);

        $cert =  $this->certificatesHelper->formatDataCertForPDF($cert);

        $pdf = app('dompdf.wrapper');
        
        $pdf->loadView('pdf.certificate', ['cert' => $cert])
            ->setPaper('a4', 'landscape')
            ;
        
        // Mostrar el PDF en el navegador en stream
        return $pdf->stream($cert->uuid.'.pdf');
    }
    
}