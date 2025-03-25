<?php

namespace App\Http\Controllers;

use App\User;
use App\Constants\Messages;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;


class ProfileController extends Controller
{

    private $userRepository;
    private $msCertValidation;

	public function __construct(UserRepository $userRepository, MSCertValidation $msCertValidation) 
    {
        $this->userRepository = $userRepository;
        $this->msCertValidation = $msCertValidation;
    }

    public function panel(Request $request)
    {
        $certificates = [];
        $user = Auth::user();
        $query = [
            'alumnoId' => $user->id
        ];
        try{
            $certificates = $this->msCertValidation->getCertificates($query)->response->data;
        } catch(ClientException $ex){
            Log::error("ProfileController::panel. Error al obtener certificados del usuario $user->id");
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




}