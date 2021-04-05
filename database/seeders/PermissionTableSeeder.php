<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        $adminRole = Role::where('name', User::ADMIN_ROLE)->first();
        $userRole = Role::where('name', User::USER_ROLE)->first();
        $category_permission = [
            'category_management_access',
            'category_create',
            'category_edit',
            'category_delete'
        ];

        foreach ($category_permission as $value) {
            $categoryPermission = Permission::create([
                'name' => $value
            ]);
            $userRole->givePermissionTo($categoryPermission);
        }

        $blog_permission = [
            'blog_management_access',
            'blog_create',
            'blog_edit',
            'blog_delete'
        ];

        foreach ($blog_permission as $value) {
            $blogpermission = Permission::create([
                'name' => $value
            ]);
            $userRole->givePermissionTo($blogpermission);
        }
    }
}