<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$m0lnrt81Q48py4.d8PZ6u.RkLUiL42RKMT37.0mSTEVzl2xW89Xfm', // password
        ];
    }
}