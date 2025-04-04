<?php

namespace App\Repositories;

use App\User;


class UserRepository
{

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)
                    ->firstOrFail();
    }
    
    public function updateUser($userId, $data)
    {
        $user = User::findOrFail($userId);
        $user->update($data);

        return $user;
    }
        
    public function resetUserPassword($userId, $newPass)
    {
        $user = User::findOrFail($userId);
        $user->password = bcrypt($newPass);
        $user->confirmed = true;
        $user->update();

        return $user;
    }
        
}