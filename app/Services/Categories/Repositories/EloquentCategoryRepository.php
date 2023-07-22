<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use app\Services\Categories\DTO\StoreCategoryDTO;
use app\Services\Categories\DTO\UpdateCategoryDTO;

class EloquentCategoryRepository implements CategoryRepository
{
    public function find(int $id): ?Category
    {
        return Category::query()->find($id);
    }

    public function store(StoreCategoryDTO $dto): Category
    {
        return Category::query()->create($dto->toArray());
    }

    public function update(Category $category, UpdateCategoryDTO $dto): Category
    {
        $category->fill($dto->toArray())->save();

        return $category;
    }

    public function delete(int $id): void
    {
        Category::destroy($id);
    }
}
