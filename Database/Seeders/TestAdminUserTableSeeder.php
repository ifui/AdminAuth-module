<?php

namespace Modules\AdminAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\AdminAuth\Entities\AdminUser;

class TestAdminUserTableSeeder extends Seeder
{
    /**
     * 生成测试数据库模拟数据
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        AdminUser::factory()->count(35)->create();
    }
}
