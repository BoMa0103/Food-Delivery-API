<?php

namespace Tests\Feature\Http\Packages;

use App\Services\Packages\DTO\UpdatePackageDTO;
use Nette\Utils\Random;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class UpdatePackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray(
            PackageGenerator::updatePackageDTOArrayGenerate([
                'company_id' => $package->company_id,
            ])
        );
        $response = $this->put(route('packages.update', ['package' => $package->id]), [
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
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray(
            PackageGenerator::updatePackageDTOArrayGenerate([
                'company_id' => $package->company_id,
            ])
        );
        $response = $this->put(route('packages.update', ['package' => $package->id]), [
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

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray(
            PackageGenerator::updatePackageDTOArrayGenerate([
                'company_id' => $package->company_id,
            ])
        );
        $response = $this->put(route('packages.update', ['package' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray(
            PackageGenerator::updatePackageDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->put(route('packages.update', ['package' => $package->id]), [
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
