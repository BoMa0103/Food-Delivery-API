<?php

namespace Tests\Feature\Http\Users;

use App\Services\Users\DTO\StoreUserDTO;
use Nette\Utils\Random;
use Tests\TestCase;

class StoreUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dto = StoreUserDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'email' => Random::generate(20, 'a-z'),
            'password' => Random::generate(8, 'a-z1-9'),
        ]);
        $response = $this->post(route('users.store'), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $dto = StoreUserDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'email' => Random::generate(20, 'a-z'),
            'password' => Random::generate(8, 'a-z1-9'),
        ]);
        $response = $this->post(route('users.store'), [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
