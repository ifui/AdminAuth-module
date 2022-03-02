<?php

namespace Modules\AdminAuth\Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * 用户注册测试
     *
     * @return void
     */
    public function testExample()
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
}
