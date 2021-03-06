<?php

namespace Modules\AdminAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminAuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SuperAdminInitSeeder::class);

        // 生成测试数据
        // $this->call(TestAdminUserTableSeeder::class);
    }
}
