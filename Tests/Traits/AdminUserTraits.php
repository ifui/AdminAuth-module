<?php

namespace Modules\AdminAuth\Tests\Traits;

use Modules\AdminAuth\Database\Seeders\SuperAdminInitSeeder;
use Modules\AdminAuth\Entities\AdminUser;

trait AdminUserTraits
{
    /**
     * 普通管理员用户登录
     *
     * @return User
     */
    private function adminLogin()
    {
        $user = AdminUser::factory()->create([
            'username' => 'admin',
            'password' => '123456',
            'status' => 1
        ]);

        // 后台用户登录（具有权限）
        $response = $this->postJson('/admin/login', [
            'username' => $user->username,
            'password' => '123456'
        ]);
        $response->assertJson([
            'success' => true
        ]);

        return AdminUser::where('username', $user->username)->first();
    }

    /**
     * 超级管理员用户登录
     *
     * @return User
     */
    private function superAdminLogin()
    {
        $this->seed(SuperAdminInitSeeder::class);

        // 后台用户登录（具有权限）
        $response = $this->postJson('/admin/login', [
            'username' => 'ifui',
            'password' => 'admin'
        ]);
        $response->assertJson([
            'success' => true
        ]);

        return AdminUser::where('username', 'ifui')->first();
    }
}
