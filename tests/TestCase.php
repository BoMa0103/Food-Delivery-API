<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Generators\UserGenerator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function generateUserBearerToken(): string
    {
        $user = UserGenerator::generate([
            'password' => 'password',
        ]);
        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ], [
            'Accept' => 'application/json',
        ]);

        return $response->json('access_token');
    }
}
