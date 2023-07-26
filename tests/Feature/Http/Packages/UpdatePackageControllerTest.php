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
        $dto = UpdatePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => $package->company_id,
        ]);
        $response = $this->put(route('packages.update', ['package' => $package->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => $package->company_id,
        ]);
        $response = $this->put(route('packages.update', ['package' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'company_id' => Random::generate(2, '1-9'),
        ]);
        $response = $this->put(route('packages.update', ['package' => $package->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
