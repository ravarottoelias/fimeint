<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
 
use App\Constants\Messages;
use Illuminate\Http\Request;
use App\Helpers\CertificateService;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;


class ProfileController extends Controller
{

    private $userRepository;
    private $certificateService;

	public function __construct(UserRepository $userRepository, CertificateService $certificateService) 
    {
        $this->userRepository = $userRepository;
        $this->certificateService = $certificateService;
    }

    public function panel(Request $request)
    {
        $certificates = [];
        $user = Auth::user();
        $request->merge([
            'alumnoId' => $user->id,
            'orderBy' => 'created_desc'
        ]);
        try{
            $certificates = $this->certificateService->getCachedCetificates($request);
        } catch(ClientException $ex){
            Log::error("ProfileController::panel. Error al obtener certificados del usuario $user->id", $ex->getMessage());
        }

        return view('sitio.users.panel', compact('user', 'certificates'));
    }

    public function showAccount() {
        $certificates = [];
        $user = Auth::user();

        return view('sitio.users.account.edit', compact('user'));
    }

    public function updateAccount(Request $request, User $user)
    {
        $request->validate([
            'documento_tipo' => 'required|max:255',
            //'email' => 'required|email|unique:users',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'documento_nro' => 'required|max:255',
            'documento_nro' => 'required|max:255',
            'codigo_tel_pais' => 'required|max:255',
            'telefono' => 'required|max:255',
            'pais' => 'required|max:255',
            'provincia' => 'required|max:255',
        ]);
    
        $user = $this->userRepository->updateUser($user->id, $request->all());

        return back()->with('success', Messages::UPDATED_SUCCESSFULL);
    }

    public function formChangePassword() {
        
        $user = Auth::user();
        
        return view('sitio.users.password.changepassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
            // Validación de los datos
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ]);

            // Verificar si la contraseña actual es correcta
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                Session::flash('error', 'La contraseña actual no es correcta.'); 
                return back();
            }

            // Actualizar la contraseña
            Auth::user()->update([
                'password' => Hash::make($request->new_password)
            ]);
            Session::flash('success', 'La contraseña fué actializada.'); 
            return back();
    }

    public function myCourses() 
    {
        $user = Auth::user();

        $inscriptions = $user->inscriptions()->with('curso')->orderBy('created_at', 'desc')->get();

        return view('sitio.users.my-courses.index', compact('inscriptions'));
        
    }

    public function myCertificates(Request $request) 
    {
        $certificates = [];
        $user = Auth::user();
        $request->merge([
            'alumnoId' => $user->id,
            'orderBy' => 'created_desc'
        ]);
        try{
            $certificates = $this->certificateService->getCachedCetificates($request);
        } catch (Exception $ex) {
            Log::error("ProfileController::panel. Error al obtener certificados del usuario $user->id", $ex->getMessage());
        }

        return view('sitio.users.my-certificates.index', compact('certificates'));
        
    }




}