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
use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{

    private $userRepository;

	public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
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
        return view('admin.users.edit', compact('user'));
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
}
