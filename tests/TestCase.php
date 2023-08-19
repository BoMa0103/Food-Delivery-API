<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Generators\UserGenerator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function generateUserBearerToken(?User $user = null): string
    {
        return $this->generateBearerToken($user, User::USER);
    }

    public function generateAdminBearerToken(?User $user = null): string
    {
        return $this->generateBearerToken($user, User::ADMIN);
    }

    private function generateBearerToken(?User $user, string $role): string
    {
        if(!$user){
            $user = UserGenerator::generate([
                'password' => 'password',
            ]);
        }

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
