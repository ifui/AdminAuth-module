<?php

namespace Modules\AdminAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\AdminAuth\Entities\AdminUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SuperAdminInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 创建超级管理员
        $role = Role::updateOrCreate(
            [
                'guard_name' => 'admin',
                'name' => 'super-admin',
            ],
            [
                'guard_name' => 'admin',
                'name' => 'super-admin',
                'description' => '超级管理员'
            ]
        );

        $super_user = AdminUser::updateOrCreate(
            [
                'username' => 'ifui',
            ],
            [
                'uuid' => (string) Str::uuid(),
                'username' => 'ifui',
                'nickname' => '超级管理员',
                'password' => 'admin',
                'email' => 'ifui@foxmail.com',
                'status' => 1
            ]
        );

        $super_user->syncRoles($role);
    }
}
