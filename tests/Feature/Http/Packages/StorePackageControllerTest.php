<?php

namespace Tests\Feature\Http\Packages;

use App\Services\Packages\DTO\StorePackageDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class StorePackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('packages.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('packages.store'), [
            'description' => $dto->getDescription(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('packages.store'), [
            'description' => $dto->getDescription(),
            'company_id' => Random::generate(1, 'a-z'),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
