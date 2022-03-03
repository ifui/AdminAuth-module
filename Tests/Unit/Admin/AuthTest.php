<?php

namespace Modules\AdminAuth\Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Lang;
use Modules\AdminAuth\Entities\AdminUser;

class AuthTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * 用户注册测试
     *
     * @return void
     */
    public function test_register()
    {
        $username = $this->faker->userName;

        $response = $this->postJson('/admin/register', [
            'username' => $username,
            'nickname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'password' => 'admin',
        ]);

        $response->assertJson([
            'success' => true,
        ]);
    }

    /**
     * 测试用户登录、刷新令牌
     *
     * @return void
     */
    public function test_login()
    {
        // 创建测试账号
        $username = 'ifui';
        $password = '123456';

        AdminUser::factory()->create([
            'username' => $username,
            'password' => $password
        ]);

        // 测试登录
        $response = $this->postJson('/admin/login', [
            'username' => $username,
            'password' => $password
        ]);
        $response->assertJson([
            'success' => true
        ]);
        $token = $response->json('data.access_token');
        $type = $response->json('data.token_type');

        // 测试刷新令牌
        $response = $this->getJson('/admin/refresh');
        $response->assertJson([
            'success' => true
        ]);

        // 测试用户登出
        $response = $this->getJson('/admin/logout');
        $response->assertJson([
            'success' => true
        ]);
    }
}
