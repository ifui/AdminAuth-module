<?php

namespace Modules\AdminAuth\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\AdminAuth\Entities\AdminUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'nickname' => $this->faker->unique()->name(4) . $this->faker->unique()->name(2),
            'username' => (string) Str::uuid(),
            'email' => $this->faker->unique()->userName(4) . $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone' => $this->faker->unique()->phoneNumber,
            'phone_verified_at' => now(),
            'password' => 'admin',
        ];
    }
}
