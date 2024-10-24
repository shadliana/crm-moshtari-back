<?php

namespace Modules\UserManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagement\app\Models\User;
use Modules\UserManagement\app\Models\UserRole;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->name,
            'password' => fake()->password,
        ];
    }
}
