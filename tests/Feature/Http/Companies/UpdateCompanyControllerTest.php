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
        $dto = UpdateCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(20, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-5'),
            'description' => Random::generate(20, 'a-z'),
        ]);
        $response = $this->put(route('companies.update', ['company' => $company->id]), [
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

    public function testIdIsNotIntExpectsSuccess(): void
    {
        $order = CompanyGenerator::generate();
        $dto = UpdateCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(20, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-5'),
            'description' => Random::generate(20, 'a-z'),
        ]);
        $response = $this->put(route('companies.update', ['company' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'address' => $dto->getAddress(),
            'rating' => $dto->getRating(),
            'status' => $dto->getStatus(),
            'description' => $dto->getDescription(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
