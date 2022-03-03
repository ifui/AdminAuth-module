<?php

namespace Modules\AdminAuth\Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AdminAuth\Entities\AdminUser;
use Modules\AdminAuth\Tests\Traits\AuthTraits;

class AdminUserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use AuthTraits;

    /**
     * 普通管理员访问管理员用户管理页面应当失败
     *
     * @return void
     */
    public function test_admin_index()
    {
        $this->adminLogin();

        $response = $this->getJson('/admin/admin_users');
        $response->assertJson([
            'success' => false,
        ]);
    }

    /**
     * 超级管理员应当有权限操作后台管理页面
     *
     * @return void
     */
    public function test_super_admin_index()
    {
        $this->superAdminLogin();

        AdminUser::factory()->count(25)->create();

        $response = $this->getJson('/admin/admin_users?pageSize=2&include=roles,permissions');
        $response->assertJson([
            'success' => true,
        ]);
    }
}
