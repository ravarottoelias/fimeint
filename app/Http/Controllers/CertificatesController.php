<?php

namespace App\Http\Controllers;

use App\User;
use App\Curso;
use Exception;
use App\Inscripcion;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helpers\CursosHelper;
use Illuminate\Http\Response;
use App\Helpers\CertificatesHelper;
use Illuminate\Support\Facades\Log;
use App\RestClients\MSCertValidation;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\ClientException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\CertificateStoreRequest;

class CertificatesController extends Controller
{
    private $msCertValidation;
    private $certificatesHelper;

    public function __construct(MSCertValidation $msCertValidation, CertificatesHelper $certificatesHelper) {
        $this->msCertValidation = $msCertValidation;
        $this->certificatesHelper = $certificatesHelper;
    }

    function index() : View {
        try {
            $certificates = $this->msCertValidation->getCertificates()->response;
            $certificates = $this->certificatesHelper->buildResponseCertificates($certificates);
            return view('admin.certificates.index', compact('certificates'));
        } catch (\Throwable $ex) {
            Log::error("Error al obtener certificados: " . $ex->getMessage());
            $certificates = [];
            Session::flash('error', "Error al obtener certificados. " . $ex->getMessage()); 
            return view('admin.certificates.index', compact('certificates'));
        }
        
    }

    function show($idCertificado) : View {
        try {
            $certificate = $this->msCertValidation->getCertificateDetails($idCertificado)->response;
            $qrcode = QrCode::format('png')->size(300)->format('png')->generate($certificate->codigoQr);
            $qrcode = base64_encode($qrcode);
            $inscription = null;
            try{
                $inscription = Inscripcion::where('curso_id', $certificate->cursoId)->where('user_id', $certificate->alumnoId)->first();
            } catch(Exception $ex) {
                Log::error("Error al buscar inscripcion. Certificado ID: " . $certificate->id, $ex);
            }
            return view('admin.certificates.show', compact('certificate', 'qrcode', 'inscription'));
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

    function deleteCert($idCertificado) {
        try {
            $certificate = $this->msCertValidation->deleteCertificate($idCertificado)->response;
            return redirect()->route('certificates');
        } catch (\Throwable $ex) {
            Log::error("Error al eliminar certificados: " . $ex->getMessage());
            $certificate = null;
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
        return view('admin.certificates.create-step-two', compact('inscripcion', 'alumno', 'curso'));
    }

    function store(CertificateStoreRequest $request) {
        try{
            $inscripcion = Inscripcion::findOrFail($request->inscripcion_id);
            $alumno = User::find($inscripcion->user_id);
            $curso = Curso::find($inscripcion->curso_id);
            $msRequest = CertificatesHelper::buildStoreCertificateRequest($curso, $alumno, $request->certificado_numero, $request->tf_certificado_numero);

            $certificate = $this->msCertValidation->createCert($msRequest)->response;
            $inscripcion->ms_certificate_id = $certificate->id;
            $inscripcion->save();
            Session::flash('success', "El certificado se creó correctamente."); 
            return Redirect::route('certificates_show', $certificate->id)->with('message', 'State saved correctly!!!'); 
        } 
        catch (ClientException $ex){
            if($ex->getResponse()->getStatusCode() == Response::HTTP_BAD_REQUEST){
                $errors = json_decode($ex->getResponse()->getBody()->getContents(), true);
                Session::flash('apiValidationErrors', $errors['errors']); 
                return Redirect::back();
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
}
