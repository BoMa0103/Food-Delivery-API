<?php

namespace Tests\Feature\Http\Packages;

use App\Services\Packages\DTO\StorePackageDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class StorePackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('packages.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsForbidden(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('packages.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertForbidden();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('packages.store'), [
            'description' => $dto->getDescription(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('packages.store'), [
            'description' => $dto->getDescription(),
            'company_id' => Random::generate(1, 'a-z'),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->post(route('packages.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
