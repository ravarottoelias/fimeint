<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Requests\CertificateStoreRequest;
use App\Inscripcion;
use Exception;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\RestClients\MSCertValidation;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    private $msCertValidation;

    public function __construct(MSCertValidation $msCertValidation) {
        $this->msCertValidation = $msCertValidation;
    }

    function index() : View {
        try {
            $certificates = $this->msCertValidation->getCertificates()->response;
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
            return view('admin.certificates.show', compact('certificate'));
        } catch (\Throwable $ex) {
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

    function create() : View {
        return view('admin.certificates.create');
    }

    function store(CertificateStoreRequest $request) {
        try{
            $inscripcion = Inscripcion::findOrFail($request->inscripcionId);
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
                'curso_total_hs' => $curso->totalHs,
                'curso_fecha_inicio' => $curso->fechaInicio,
                'curso_fecha_fin' => $curso->fechaFin,
                'curso_homologacion' => 'HMJM123',
                'habilitacion_numero' => '21',
                'certificado_numero' => '#123',
                'tf_certificado_numero' => '1.2',
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
