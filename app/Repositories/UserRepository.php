<?php

namespace App\Repositories;

use App\User;


class UserRepository
{
    public function getAll($name, $email, $order = 'desc')
    {
        return User::name($name)
                    ->email($email)
                    ->orderBy('created_at', $order)
                    ->get();
    }

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
        
    public function resetUserPassword($userId)
    {
        $user = User::findOrFail($userId);
        $user->password = bcrypt($user->documento_nro);
        $user->update();

        return $user;
    }
        
}