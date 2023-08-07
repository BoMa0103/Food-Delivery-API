<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Generators\UserGenerator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function generateUserBearerToken(string $role = 'user'): string
    {
        $user = UserGenerator::generate([
            'password' => 'password',
        ]);

        $user->role = $role;
        $user->save();

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ], [
            'Accept' => 'application/json',
        ]);

        return $response->json('access_token');
    }
}
