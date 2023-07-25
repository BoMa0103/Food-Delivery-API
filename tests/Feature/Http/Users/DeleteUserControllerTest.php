<?php

namespace Tests\Feature\Http\Users;

use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class DeleteUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $package = UserGenerator::generate();
        $response = $this->delete(route('users.delete', [
            'user' => $package->id,
        ]));

        $response->assertNoContent();
    }

    public function testUserDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(2, '0-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('users.delete', [
            'user' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
