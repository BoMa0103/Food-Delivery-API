<?php

namespace Tests\Feature\Http\Categories;

use App\Services\Categories\DTO\StoreCategoryDTO;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class StoreCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
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
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
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
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'company_id' => Random::generate(1, 'a-z'),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
