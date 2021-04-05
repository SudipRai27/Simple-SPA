<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{
    public function getRole($roleName)
    {
        return Role::where('name', $roleName)->first();
    }
}