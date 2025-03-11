<?php

namespace App\Http\Controllers;

use App\User;
use App\Curso;
use Exception;
use App\Inscripcion;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helpers\CertificatesHelper;
use Illuminate\Support\Facades\Log;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
            return view('admin.certificates.show', compact('certificate', 'qrcode'));
        } catch (\Throwable $ex) {
            dd($ex);
            Log::error("Error al obtener el certificado: " . $ex->getMessage());
            $certificate = null;
            Session::flash('error', "Error al obtener el certificado. " . $ex->getMessage()); 
            return view('admin.certificates.show', compact('certificate'));
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
            $msRequest = [
                'codigo_qr' => $curso->id . '-' . $alumno->id,
                'cuit' => str_replace('-', '', $alumno->cuit),
                'alumno_id' => $alumno->id,
                'nombre_alumno' => strtoupper($alumno->fullName()),
                'curso_id' => $curso->id,
                'titulo_curso' => $curso->titulo,
                'fecha_curso' => $curso->created_at->format('m-Y'), // porbablemente eliminar.
                'curso_total_hs' => $curso->total_hs,
                'curso_fecha_inicio' => $curso->fecha_inicio,
                'curso_fecha_fin' => $curso->fecha_fin,
                'curso_homologacion' => $curso->curso_homologacion,
                'habilitacion_numero' => config('custom.certificates.cert_habilitacion_nro'),
                'certificado_numero' => $request->certificado_numero,
                'tf_certificado_numero' => $request->tf_certificado_numero,
            ];
            $certificate = $this->msCertValidation->createCert($msRequest)->response;
            Session::flash('success', "El certificado se creó correctamente."); 
            return Redirect::route('certificates_show', $certificate->id)->with('message', 'State saved correctly!!!'); 
        } catch(Exception $ex) {
            Log::error('Error al crear el certificado: ' . $ex->getMessage());
            Session::flash('error', "Error al crear el certificado. " . $ex->getMessage()); 
            return Redirect::back();
        }
    }
}
