<?php

namespace App\Services\Dishes\Repositories;

use App\Models\Dish;
use app\Services\Dishes\DTO\StoreDishDTO;
use app\Services\Dishes\DTO\UpdateDishDTO;
use Illuminate\Database\Eloquent\Collection;

interface DishRepository
{
    public function index(): Collection;
    public function find(int $id): ?Dish;
    public function store(StoreDishDTO $dto): Dish;
    public function update(Dish $dish, UpdateDishDTO $dto): Dish;
    public function delete(int $id): void;
}
