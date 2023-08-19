<?php

namespace Tests\Feature\Http\Users;

use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class DeleteUserControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $user = UserGenerator::generate();

        $response = $this->delete(route('users.delete', [
            'user' => $user->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsNoContentWithUserOwner(): void
    {
        $user = UserGenerator::generate([
            'password' => 'password',
        ]);

        $response = $this->delete(route('users.delete', [
            'user' => $user->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken($user),
            'Accept' => 'application/json',
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $package = UserGenerator::generate();
        $response = $this->delete(route('users.delete', [
            'user' => $package->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testUserDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(4, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
