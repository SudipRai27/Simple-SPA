<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterService
{
    public function register($data)
    {
        $role = (new RoleService)->getRole(User::USER_ROLE);
        if (!$role) {
            throw new ModelNotFoundException('User role not found in db');
        }
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return $user->assignRole($role);
    }
}