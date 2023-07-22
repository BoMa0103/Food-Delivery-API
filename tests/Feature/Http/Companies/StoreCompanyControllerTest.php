<?php

namespace Tests\Feature\Http\Companies;

use App\Services\Companies\DTO\StoreCompanyDTO;
use Nette\Utils\Random;
use Tests\TestCase;

class StoreCompanyControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dto = StoreCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(20, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-5'),
            'description' => Random::generate(20, 'a-z'),
        ]);
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $dto = StoreCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(20, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-5'),
            'description' => Random::generate(20, 'a-z'),
        ]);
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'description' => $dto->getDescription(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $dto = StoreCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(20, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-5'),
            'description' => Random::generate(20, 'a-z'),
        ]);
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => Random::generate(1, 'a-z'),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
