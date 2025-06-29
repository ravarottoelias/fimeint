<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\Utils;
use App\Helpers\Helper;
use App\Constants\Messages;
use App\Filters\UserFilter;
use Illuminate\Http\Request;
use App\Mail\UserPasswordReseted;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\RestClients\MSCertValidation;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UserStoreRequest;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Notifications\NewTemporaryPasswordNotification;

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
        $userFilter = new UserFilter($request);

        $query = request()->getQueryString();
        
        $users = Cache::remember("users_page_{$query}", now()->addMinutes(10), function () use ($userFilter) {
            return User::filter($userFilter)
                ->orderBy('created_at', 'DESC')
                ->paginate(15)
                ->appends($userFilter->request->query());
        });
        
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
        $certificates = null;
        $query = [
            'alumnoId' => $user->id
        ];
        try{
            $certificates = $this->msCertValidation->getCertificates($query)->response->data;
        } catch(ClientException $ex){
            Log::error("Error al obtener certificados del usuario $user->id.", $ex->getMessage());
        }

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
        Cache::flush();
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
        
        Cache::flush();
        return back()->with('success', $msg);
    }
    
    public function sendEmailPasswordReset(Request $request)
    {
        
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            $newPassword = Helper::makeNewPassword($user);
            
            $user->password = bcrypt($newPassword);
            
            $user->update();
            
            Cache::flush();
            Mail::to($user->email)->send(new UserPasswordReseted($user, $newPassword));
        }
             

        return view('sitio.recuperar-contrasenia-email-enviado', compact('user'));

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

    public function destroy(User $user) {
        $user->delete();
        Cache::flush();
        return redirect()->route('users.index')
                     ->with('success', 'Usuario eliminado correctamente.');
    }
}
