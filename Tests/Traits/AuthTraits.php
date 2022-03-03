<?php

namespace Modules\AdminAuth\Tests\Traits;

use Modules\AdminAuth\Database\Seeders\SuperAdminInitSeeder;
use Modules\AdminAuth\Entities\AdminUser;

trait AuthTraits
{
    /**
     * 管理员用户登录
     *
     * @return App\Models\AdminUser
     */
    private function adminLogin()
    {
        AdminUser::factory()->create([
            'username' => 'admin'
        ]);

        // 后台用户登录（具有权限）
        $loginResponse = $this->postJson('admin/login', [
            'username' => 'admin',
            'password' => 'admin',
        ]);
        $loginResponse->assertJson([
            'success' => true,
        ]);

        return AdminUser::where('username', 'admin')->first();
    }

    /**
     * 超级管理员用户登录
     *
     * @return App\Models\AdminUser
     */
    private function superAdminLogin()
    {
        $this->seed(SuperAdminInitSeeder::class);

        // 超级管理员登录
        $response = $this->postJson('admin/login', [
            'username' => 'ifui',
            'password' => 'admin',
        ]);
        $response->assertJson([
            'success' => true,
        ]);

        return AdminUser::where('username', 'ifui')->first();
    }
}
