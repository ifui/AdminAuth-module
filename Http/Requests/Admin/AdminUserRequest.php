<?php

namespace Modules\AdminAuth\Http\Requests\Admin;

use App\Http\Requests\MethodRequest;
use App\Rules\Phone;

class AdminUserRequest extends MethodRequest
{
    public function postRules()
    {
        return [
            'username' => 'required|min:4|max:30',
            'nickname' => 'min:1|max:40',
            'phone' => [new Phone()],
            'password_confirmation' => 'min:5|max:20',
            'password' => 'required_with:password_confirmation|min:5|max:20',
            'email' => 'email|unique:admin_users',
            'sex' => 'in:0,1,2',
        ];
    }

    public function patchRules()
    {
        return [
            'nickname' => 'min:1|max:40',
            'phone' => [new Phone()],
            'password_confirmation' => 'min:5|max:20',
            'password' => 'required_with:password_confirmation|min:5|max:20',
            'email' => 'email|unique:admin_users',
            'status' => 'in:0,1',
            'email_verified_at' => 'date',
            'phone_verified_at' => 'date',
        ];
    }
}
