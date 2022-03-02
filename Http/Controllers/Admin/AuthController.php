<?php

namespace Modules\AdminAuth\Http\Controllers\Admin;

use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\AdminAuth\Entities\AdminUser;
use Modules\AdminAuth\Http\Requests\Admin\LoginRequest;
use Modules\AdminAuth\Http\Requests\Admin\RegisterRequest;

class AuthController extends Controller
{
    /**
     * 注册用户
     *
     * @param RegisterRequest $request
     * @return  Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $admin_user = new AdminUser();

        $admin_user['uuid'] = (string) Str::uuid();
        $admin_user['password'] = $request->get('password');
        $admin_user->fill($request->validated());

        if ($admin_user->save()) {
            return success();
        } else {
            return error();
        }
    }

    /**
     * 用户登录
     *
     * @param LoginRequest $request
     * @return Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $admin_user = AdminUser::where('username', $request->username)->first();

        if (!Hash::check($request->password, $admin_user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('auth.password')],
            ]);
        }

        // 认证用户实例
        if (!auth('admin')->attempt($request->validated())) {
            return error('adminauth::code.4001');
        }

        // 创建新令牌前，删除旧登录令牌
        $admin_user->tokens()->where('name', 'admin-login-token')->delete();

        return $this->respondWithToken($admin_user);
    }

    /**
     * 刷新登录令牌
     *
     * @param Request $request
     * @return Illuminate\Http\Responsee
     */
    public function refresh(Request $request)
    {
        return $this->respondWithToken($request->user());
    }

    /**
     * 生成 Token
     *
     * @param Modules\AdminAuth\Entities\AdminUser|Illuminate\Auth\GenericUser $admin_user
     * @return Illuminate\Http\Responsee
     */
    public function respondWithToken(AdminUser|GenericUser $admin_user)
    {
        $token = $admin_user->createToken('admin-login-token')->plainTextToken;

        if (isset($token)) {
            return success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('sanctum.expiration'),
            ]);
        } else {
            return error('adminauth::code.4002');
        }
    }
}
