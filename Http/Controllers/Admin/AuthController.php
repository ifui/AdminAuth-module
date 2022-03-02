<?php

namespace Modules\AdminAuth\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\AdminAuth\Entities\AdminUser;
use Modules\AdminAuth\Http\Requests\Admin\RegisterRequest;

class AuthController extends Controller
{
    /**
     * 注册用户
     *
     * @param RegisterRequest $request
     * @return void
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
}
