<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // \App\Models\Role::first();
        $role = \App\Models\Role::pluck('id')->first();
        return [
            //
            'name'     => 'Test',
            'email'    => 'test@email.com',
            'password' => Hash::make('123'),
            'role_id'  => $role,
        ];
    }
}
