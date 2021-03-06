<?php

use Illuminate\Http\Request;
use Modules\AdminAuth\Http\Controllers\Admin\AdminUserController;
use Modules\AdminAuth\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 用户注册
Route::post('/register', [AuthController::class, 'register']);
// 用户登录
Route::post('/login', [AuthController::class, 'login']);
// 用户登出
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
// 刷新令牌
Route::middleware('auth:sanctum')->get('/refresh', [AuthController::class, 'refresh']);
// 用户信息
Route::middleware('auth:sanctum')->get('/userinfo', [AuthController::class, 'userinfo']);

// 管理员用户管理
Route::middleware('auth:sanctum')->resource('/admin_users', AdminUserController::class);
