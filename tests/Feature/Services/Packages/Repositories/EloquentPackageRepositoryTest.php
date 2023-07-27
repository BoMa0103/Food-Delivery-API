<?php

namespace Tests\Feature\Services\Packages\Repositories;

use App\Models\Package;
use App\Services\Packages\DTO\StorePackageDTO;
use App\Services\Packages\DTO\UpdatePackageDTO;
use App\Services\Packages\Repositories\EloquentPackageRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class EloquentPackageRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentPackageRepository(): EloquentPackageRepository
    {
        return app(EloquentPackageRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = PackageGenerator::generate();
        $order = $this->getEloquentPackageRepository()->find($model->id);
        $this->assertNotNull($order);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $order = $this->getEloquentPackageRepository()->find($id);

        $this->assertNull($order);
    }

    public function testCreateExpectsSuccess():void
    {
        $model = CompanyGenerator::generate();
        $dto = StorePackageDTO::fromArray(
            PackageGenerator::storePackageDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $this->getEloquentPackageRepository()->store($dto);

        $model = Package::query()->where('name', $dto->getName())->first();
        $this->assertEquals($dto->getDescription(), $model->description);
        $this->assertEquals($dto->getPrice(), $model->price);
        $this->assertEquals($dto->getCompanyId(), $model->company_id);
        $this->assertDatabaseCount('packages', 1);
    }

    public function testUpdateExpectsSuccess():void
    {
        $package = PackageGenerator::generate();
        $dto = UpdatePackageDTO::fromArray(
            PackageGenerator::updatePackageDTOArrayGenerate([
                'company_id' => $package->company_id,
            ])
        );
        $oldCompanyId = $package->company_id;
        $oldName = $package->name;
        $oldPrice = $package->price;
        $this->getEloquentPackageRepository()->update($package, $dto);

        $package->refresh();

        $this->assertEquals($oldCompanyId, $package->company_id);
        $this->assertNotEquals($oldName, $package->name);
        $this->assertNotEquals($oldPrice, $package->price);
    }

    public function testDeleteExpectsSuccess():void
    {
        $package = PackageGenerator::generate();
        $this->getEloquentPackageRepository()->delete($package->id);

        $this->assertNull($package->fresh());
        $this->assertDatabaseCount('packages', 0);
    }
}
