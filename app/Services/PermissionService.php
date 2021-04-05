<?php

namespace App\Services;

use App\Models\User;

class PermissionService
{
    public function getPermissions(User $user)
    {
        $permissions = [];
        foreach ($user->getPermissionsViaRoles() as $permission) {
            $arr = [];
            $arr['id'] = $permission->id;
            $arr['name'] = $permission->name;
            array_push($permissions, $arr);
        }
        return $permissions;
    }
}