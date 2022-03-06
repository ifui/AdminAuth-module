<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{
    use HasFactory;
    use HasApiTokens; // sanctum
    use HasRoles; // permissions

    protected $fillable = [
        'username',
        'nickname',
        'password',
        'email',
        'phone',
        'avatar',
        'sex',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Factory
     *
     * @return void
     */
    protected static function newFactory()
    {
        return \Modules\AdminAuth\Database\factories\AdminUserFactory::new();
    }

    /**
     * Password field
     *
     * @return Attribute
     */
    public function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => Hash::make($value),
        );
    }
}
