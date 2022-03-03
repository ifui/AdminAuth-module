<?php

namespace Modules\AdminAuth\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\AdminAuth\Entities\AdminUser;

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

    /**
     * 账号本人才有权限
     *
     * @param AdminUser $adminUser
     * @param AdminUser $model
     * @return boolean
     */
    public function isOwner(AdminUser $adminUser, AdminUser $model)
    {
        return $adminUser->uuid == $model->uuid;
    }
}
