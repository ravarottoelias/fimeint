<?php

namespace App\Http\Controllers;

use App\User;
use App\Constants\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;


class ProfileController extends Controller
{

    private $userRepository;

	public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }


    public function editProfile(Request $request)
    {
        $user = Auth::user();

        return view('sitio.users.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        $user = $this->userRepository->updateUser($user->id, $request->all());

        return back()->with('success', Messages::UPDATED_SUCCESSFULL);
    }


}