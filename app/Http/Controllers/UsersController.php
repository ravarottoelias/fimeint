<?php

namespace App\Http\Controllers;

use App\User;
use MercadoPago;
use App\Helpers\Helper;
use App\Constants\Messages;
use Illuminate\Http\Request;
use App\Mail\UserPasswordReseted;
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
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->updateUser($id, $request->all());

        return back()->with('success', Messages::UPDATED_SUCCESSFULL);
    }

    /**
     * Reset passwor by default => documento_nro.
     */
    public function resetPassword($id)
    {
        $user = $this->userRepository->resetUserPassword($id);

        $msg = 'La contraseña fué reseteada. - Nueva contraseña: '.$user->documento_nro;

        return back()->with('success', $msg);
    }

    public function recuperarPassword()
    {
        return view('sitio.recuperar-contrasenia');
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
