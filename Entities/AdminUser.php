<?php

namespace Modules\AdminAuth\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Model
{
    use HasFactory;
    use HasApiTokens; // sanctum

    protected $fillable = [
        'username',
        'nickname',
        'password',
        'email',
        'phone',
        'avatar',
        'sex',
        'status'
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
