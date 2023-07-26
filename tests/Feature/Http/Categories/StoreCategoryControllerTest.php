<?php

namespace Tests\Feature\Http\Categories;

use App\Services\Categories\DTO\StoreCategoryDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class StoreCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'company_id' => Random::generate(1, 'a-z'),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StoreCategoryDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'company_id' => Random::generate(2, '1-9'),
        ]);
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
