<?php

namespace Tests\Feature\Http\Users;

use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class DeleteUserControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $package = UserGenerator::generate();
        $response = $this->delete(route('users.delete', [
            'user' => $package->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNoContent();
    }

    public function testUserDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
