<?php

namespace Tests\Feature\Http\Companies;

use App\Services\Companies\DTO\StoreCompanyDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class StoreCompanyControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dto = StoreCompanyDTO::fromArray(
            CompanyGenerator::storeCompanyDTOArrayGenerate()
        );
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsForbidden(): void
    {
        $dto = StoreCompanyDTO::fromArray(
            CompanyGenerator::storeCompanyDTOArrayGenerate()
        );
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertForbidden();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $dto = StoreCompanyDTO::fromArray(
            CompanyGenerator::storeCompanyDTOArrayGenerate()
        );
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $dto = StoreCompanyDTO::fromArray(
            CompanyGenerator::storeCompanyDTOArrayGenerate()
        );
        $response = $this->post(route('companies.store'), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => Random::generate(1, 'a-z'),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
