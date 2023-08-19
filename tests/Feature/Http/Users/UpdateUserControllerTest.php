<?php

namespace Tests\Feature\Http\Users;

use App\Services\Users\DTO\UpdateUserDTO;
use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UpdateUserControllerTest extends TestCase
{
    public function testExpectsSuccessWithAdmin(): void
    {
        $user = UserGenerator::generate();
        $dto = UpdateUserDTO::fromArray(
            UserGenerator::updateUserDTOArrayGenerate()
        );
        $response = $this->put(route('users.update', ['user' => $user->id]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsSuccessWithUserOwner(): void
    {
        $user = UserGenerator::generate([
            'password' => 'password',
        ]);

        $dto = UpdateUserDTO::fromArray(
            UserGenerator::updateUserDTOArrayGenerate()
        );

        $response = $this->put(route('users.update', ['user' => $user->id]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken($user),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsForbidden(): void
    {
        $user = UserGenerator::generate();
        $dto = UpdateUserDTO::fromArray(
            UserGenerator::updateUserDTOArrayGenerate()
        );
        $response = $this->put(route('users.update', ['user' => $user->id]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertForbidden();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $dto = UpdateUserDTO::fromArray(
            UserGenerator::updateUserDTOArrayGenerate()
        );
        $response = $this->put(route('users.update', ['user' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
