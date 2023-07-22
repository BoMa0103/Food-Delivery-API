<?php

namespace App\Services\Categories;

use App\Models\Category;
use app\Services\Categories\DTO\StoreCategoryDTO;
use app\Services\Categories\DTO\UpdateCategoryDTO;
use App\Services\Categories\Repositories\CategoryRepository;

class CategoriesService
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    ){
    }

    public function find(int $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    public function store(StoreCategoryDTO $dto): Category
    {
        return $this->categoryRepository->store($dto);
    }

    public function update(Category $category, UpdateCategoryDTO $dto): Category
    {
        return $this->categoryRepository->update($category, $dto);
    }

    public function delete(int $id): void
    {
        $this->categoryRepository->delete($id);
    }
}
