<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use app\Services\Categories\DTO\StoreCategoryDTO;
use app\Services\Categories\DTO\UpdateCategoryDTO;

interface CategoryRepository
{
    public function find(int $id): ?Category;
    public function store(StoreCategoryDTO $dto): Category;
    public function update(Category $category, UpdateCategoryDTO $dto): Category;
    public function delete(int $id): void;
}
