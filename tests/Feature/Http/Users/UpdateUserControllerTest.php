<?php

namespace Tests\Feature\Http\Users;

use App\Services\Users\DTO\UpdateUserDTO;
use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UpdateUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $user = UserGenerator::generate();
        $dto = UpdateUserDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'email' => Random::generate(20, 'a-z'),
            'password' => Random::generate(8, 'a-z1-9'),
        ]);
        $response = $this->put(route('users.update', ['user' => $user->id]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $dto = UpdateUserDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'email' => Random::generate(20, 'a-z'),
            'password' => Random::generate(8, 'a-z1-9'),
        ]);
        $response = $this->put(route('users.update', ['user' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
