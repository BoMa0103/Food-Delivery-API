<?php

namespace Tests\Feature\Http\Categories;

use App\Services\Categories\DTO\UpdateCategoryDTO;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class UpdateCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $dto = UpdateCategoryDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'company_id' => $category->company_id,
        ]);
        $response = $this->put(route('categories.update', ['category' => $category->id]), [
            'name' => $dto->getName(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $dto = UpdateCategoryDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'company_id' => $category->company_id,
        ]);
        $response = $this->put(route('categories.update', ['category' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
