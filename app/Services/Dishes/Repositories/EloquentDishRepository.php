<?php

namespace App\Services\Dishes\Repositories;

use App\Models\Dish;
use app\Services\Dishes\DTO\StoreDishDTO;
use app\Services\Dishes\DTO\UpdateDishDTO;

class EloquentDishRepository implements DishRepository
{
    public function find(int $id): ?Dish
    {
        return Dish::query()->find($id);
    }

    public function store(StoreDishDTO $dto): Dish
    {
        return Dish::query()->create($dto->toArray());
    }

    public function update(Dish $dish, UpdateDishDTO $dto): Dish
    {
        $dish->fill($dto->toArray())->save();

        return $dish;
    }

    public function delete(int $id): void
    {
        Dish::destroy($id);
    }
}
