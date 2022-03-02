<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('username')->unique()->comment('用户名');
            $table->string('nickname')->comment('昵称')->nullable();
            $table->string('avatar')->comment('头像')->nullable();
            $table->string('email')->unique()->nullable();
            $table->char('phone', 11)->unique()->nullable()->comment('手机号');
            $table->tinyInteger('sex')->comment('性别：0未知，1男，2女')->default(0);
            $table->tinyInteger('status')->comment('账号状态：0禁用，1正常')->default(1);
            $table->string('password');

            $table->timestamp('email_verified_at')->comment('邮箱验证状态')->nullable();
            $table->timestamp('phone_verified_at')->comment('手机号验证状态')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
};
