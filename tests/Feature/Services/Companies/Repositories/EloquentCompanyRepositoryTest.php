<?php

namespace Tests\Feature\Services\Companies\Repositories;

use App\Models\Company;
use App\Services\Companies\DTO\StoreCompanyDTO;
use App\Services\Companies\DTO\UpdateCompanyDTO;
use App\Services\Companies\Repositories\EloquentCompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class EloquentCompanyRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentCompanyRepository(): EloquentCompanyRepository
    {
        return app(EloquentCompanyRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = CompanyGenerator::generate();
        $company = $this->getEloquentCompanyRepository()->find($model->id);
        $this->assertNotNull($company);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $company = $this->getEloquentCompanyRepository()->find($id);

        $this->assertNull($company);
    }

    public function testCreateExpectsSuccess():void
    {
        $dto = StoreCompanyDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'address' => Random::generate(50, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-3'),
            'description' => Random::generate(100, 'a-z'),
        ]);
        $this->getEloquentCompanyRepository()->store($dto);

        $model = Company::query()->where('name', $dto->getName())->first();
        $this->assertEquals($dto->getStatus(), $model->status);
        $this->assertEquals($dto->getAddress(), $model->address);
        $this->assertDatabaseCount('companies', 1);
    }

    public function testUpdateExpectsSuccess():void
    {
        $company = CompanyGenerator::generate();
        $dto = UpdateCompanyDTO::fromArray([
            'name' => $company->name,
            'address' => Random::generate(50, 'a-z'),
            'rating' => Random::generate(1, '1-5'),
            'status' => Random::generate(1, '1-3'),
            'description' => Random::generate(100, 'a-z'),
        ]);
        $oldCompanyName = $company->name;
        $oldCompanyAddress = $company->address;
        $this->getEloquentCompanyRepository()->update($company, $dto);

        $company->refresh();

        $this->assertEquals($oldCompanyName, $company->name);
        $this->assertNotEquals($oldCompanyAddress, $company->address);
    }

    public function testDeleteExpectsSuccess():void
    {
        $company = CompanyGenerator::generate();
        $this->getEloquentCompanyRepository()->delete($company->id);

        $this->assertNull($company->fresh());
        $this->assertDatabaseCount('companies', 0);
    }
}
