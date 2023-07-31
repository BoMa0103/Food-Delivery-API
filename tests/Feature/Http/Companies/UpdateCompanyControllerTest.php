<?php

namespace Tests\Feature\Http\Companies;

use App\Services\Companies\DTO\UpdateCompanyDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class UpdateCompanyControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $company = CompanyGenerator::generate();
        $dto = UpdateCompanyDTO::fromArray(
            CompanyGenerator::updateCompanyDTOArrayGenerate()
        );
        $response = $this->put(route('companies.update', ['company' => $company->id]), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $dto = UpdateCompanyDTO::fromArray(
            CompanyGenerator::updateCompanyDTOArrayGenerate()
        );
        $response = $this->put(route('companies.update', ['company' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
