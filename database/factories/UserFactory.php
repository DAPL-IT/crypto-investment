<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // return [
        //     'username' => 'jhondoe',
        //     'email' => 'admin@example.com',
        //     'account_type' => 'admin',
        //     'whatsapp' => '0170000000',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('123456'), // password
        //     'remember_token' => Str::random(10),
        // ];

        return [
            'username' => 'root',
            'email' => 'root@example.com',
            'account_type' => 'super_admin',
            'whatsapp' => '01234567891',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
