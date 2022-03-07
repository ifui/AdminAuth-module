<?php

namespace Modules\AdminAuth\Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AdminAuth\Entities\AdminUser;
use Modules\AdminAuth\Tests\Traits\AdminUserTraits;

class AdminUserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use AdminUserTraits;

    /**
     * 普通管理员访问管理员用户管理页面应当失败
     *
     * @return void
     */
    public function test_admin_index()
    {
        $admin = $this->adminLogin();

        // 获取管理员列表，非超级管理员应当失败
        $response = $this->getJson('/admin/admin_users');
        $response->assertJson([
            'success' => false,
            'code' => 'code.10403'
        ]);

        // 创建管理员，非超级管理员应当失败
        $response = $this->postJson('/admin/admin_users', [
            'username' => 'ifui' . $this->faker->word(4, 8),
            'nickname' => $this->faker->word(4, 8) . $this->faker->word(2, 4),
            'password' => 'admin',
        ]);
        $response->assertJson([
            'success' => false,
            'code' => 'code.10403'
        ]);

        // 显示管理员详情，本人应当成功
        $response = $this->getJson('/admin/admin_users/' . $admin->id);
        $response->assertJson([
            'success' => true,
        ]);

        // 更新管理员，本人应当成功
        $response = $this->patchJson('/admin/admin_users/' . $admin->id, [
            'nickname' => 'admin'
        ]);
        $response->assertJson([
            'success' => true,
        ]);

        // 删除管理员, 应当失败
        $other_admin = AdminUser::factory()->create();
        $response = $this->deleteJson('/admin/admin_users/' . $other_admin->id);
        $response->assertJson([
            'success' => false,
            'code' => 'code.10403'
        ]);
    }

    /**
     * 超级管理员应当有权限操作后台管理页面
     *
     * @return void
     */
    public function test_super_admin_index()
    {
        $super_admin = $this->superAdminLogin();

        AdminUser::factory()->count(25)->create();

        // 管理员列表
        $response = $this->getJson('/admin/admin_users?pageSize=2&include=roles,permissions');
        $response->assertJson([
            'success' => true,
        ]);

        // 添加一个管理员
        $response = $this->postJson('/admin/admin_users', [
            'username' => 'admin' . $this->faker->word(4, 8),
            'nickname' => $this->faker->word(4, 8) . $this->faker->word(2, 4),
            'password' => 'admin',
        ]);
        $response->assertJson([
            'success' => true,
        ]);

        // 显示管理员详情
        $response = $this->getJson('/admin/admin_users/' . $super_admin->id);
        $response->assertJson([
            'success' => true,
        ]);

        // 更新管理员
        $response = $this->patchJson('/admin/admin_users/' . $super_admin->id, [
            'nickname' => 'admin'
        ]);
        $response->assertJson([
            'success' => true,
        ]);

        // 删除管理员
        $other_admin = AdminUser::factory()->create();
        $response = $this->deleteJson('/admin/admin_users/' . $other_admin->id);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertModelMissing($other_admin);
    }
}
