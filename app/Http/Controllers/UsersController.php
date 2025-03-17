<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\Helper;
use App\Constants\Messages;
use App\Helpers\Utils;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Mail\UserPasswordReseted;
use App\Notifications\NewTemporaryPasswordNotification;
use App\Repositories\UserRepository;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController extends Controller
{

    private $userRepository;
    private $msCertValidation;

	public function __construct(UserRepository $userRepository, MSCertValidation $msCertValidation) 
    {
        $this->userRepository = $userRepository;
        $this->msCertValidation = $msCertValidation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->getAll($request->name, $request->email);
        
       return view('admin.users.index', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $certificates = $this->msCertValidation->getCertificates()->response->data;

        return view('admin.users.edit', compact('user', 'certificates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, $id)
    {
        $user = $this->userRepository->updateUser($id, $request->all());

        return back()->with('success', Messages::UPDATED_SUCCESSFULL);
    }

    /**
     * Reset passwor by default => documento_nro.
     */
    public function resetPassword($id)
    {
        $tempPassword = Utils::generarCodigo();
        $user = $this->userRepository->resetUserPassword($id, $tempPassword);

        $user->notify(new NewTemporaryPasswordNotification($tempPassword));

        $msg = "La contraseña fué reseteada. Se envió un email a $user->email con la nueva clave temporal";

        return back()->with('success', $msg);
    }

    public function sendEmailPasswordReset(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $newPassword = Helper::makeNewPassword($user);

            $user->password = bcrypt($newPassword);
            
            $user->update();
    
            Mail::to($user->email)->send(new UserPasswordReseted($user, $newPassword));
        }
             

        return view('sitio.recuperar-contrasenia-email-enviado', compact('user'));

    }

    public function copyDniToCuil() {
        $users = User::whereNull('cuit')->get();
        foreach ($users as $user) {
            $charListReplacement = array(".", ",", " ");
            $user->cuit = str_replace($charListReplacement, "", $user->documento_nro);
            $user->save();
        }
    }

    /**
     * Api de busqueda de Usuarios por CUIT o Nombre
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request) : JsonResponse{
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = User::where('name','LIKE',"%$search%")->orWhere('cuit', 'LIKE', "%$search%")->get()
            ->map(function ($item){
                return [
                    'id' => $item->id,
                    'name' =>  $item->cuit . " - " . $item->name
                ];
            });
        }

        return response()->json($data);
    }
}
