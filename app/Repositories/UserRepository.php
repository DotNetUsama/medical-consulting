<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function create(array $userData) {
        $userData['password'] = bcrypt($userData['password']);
        $newUser = new User($userData);
        $newUser->save();
    }
}
