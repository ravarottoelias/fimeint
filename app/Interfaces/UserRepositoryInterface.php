<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getAll($name, $email, $order = 'desc');
    public function getUserById($id);
    public function getUserByEmail($email);
    public function updateUser($userId, $data);
    public function resetUserPassword($userId);
}