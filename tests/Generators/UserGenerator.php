<?php

namespace Tests\Generators;

use App\Models\User;

class UserGenerator
{
    public static function generate(array $data = []): User
    {
        return User::factory()->create($data);
    }

    public static function storeUserDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'email' => $data['email'] ?? fake()->email,
            'password' => $data['password'] ?? fake()->password,
        ];
    }

    public static function updateUserDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'email' => $data['email'] ?? fake()->email,
            'password' => $data['password'] ?? fake()->password,
        ];
    }
}
