<?php

namespace Modules\AdminAuth\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * 只有超级管理员才有权限操作
     *
     * @return boolean
     */
    public function onlySuperAdmin()
    {
        return false;
    }
}
