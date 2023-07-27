<?php

namespace Tests\Feature\Services\Categories\Repositories;

use App\Models\Category;
use App\Services\Categories\DTO\StoreCategoryDTO;
use App\Services\Categories\DTO\UpdateCategoryDTO;
use App\Services\Categories\Repositories\EloquentCategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class EloquentCategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentCategoryRepository(): EloquentCategoryRepository
    {
        return app(EloquentCategoryRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = CategoryGenerator::generate();
        $category = $this->getEloquentCategoryRepository()->find($model->id);
        $this->assertNotNull($category);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $category = $this->getEloquentCategoryRepository()->find($id);

        $this->assertNull($category);
    }

    public function testCreateExpectsSuccess():void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreCategoryDTO::fromArray(
            CategoryGenerator::storeCategoryDTOArrayGenerate([
                'company_id' => $model->id,
            ])
        );
        $this->getEloquentCategoryRepository()->store($dto);

        $model = Category::query()->where('name', $dto->getName())->first();
        $this->assertEquals($dto->getCompanyId(), $model->company_id);
        $this->assertDatabaseCount('categories', 1);
    }

    public function testUpdateExpectsSuccess():void
    {
        $category = CategoryGenerator::generate();
        $dto = UpdateCategoryDTO::fromArray(
            CategoryGenerator::updateCategoryDTOArrayGenerate([
                'company_id' => $category->company_id,
            ])
        );
        $oldCompanyId = $category->company_id;
        $oldName = $category->name;
        $this->getEloquentCategoryRepository()->update($category, $dto);

        $category->refresh();

        $this->assertEquals($oldCompanyId, $category->company_id);
        $this->assertNotEquals($oldName, $category->name);
    }

    public function testDeleteExpectsSuccess():void
    {
        $category = CategoryGenerator::generate();
        $this->getEloquentCategoryRepository()->delete($category->id);

        $this->assertNull($category->fresh());
        $this->assertDatabaseCount('categories', 0);
    }
}
