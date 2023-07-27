<?php

namespace Tests\Feature\Http\Users;

use App\Services\Users\DTO\StoreUserDTO;
use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class StoreUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dto = StoreUserDTO::fromArray(
            UserGenerator::storeUserDTOArrayGenerate()
        );
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
        $dto = StoreUserDTO::fromArray(
            UserGenerator::storeUserDTOArrayGenerate()
        );
        $response = $this->post(route('users.store'), [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
