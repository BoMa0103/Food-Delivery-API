<?php

namespace App\Services\Dishes;

use App\Models\Dish;
use app\Services\Dishes\DTO\StoreDishDTO;
use app\Services\Dishes\DTO\UpdateDishDTO;
use App\Services\Dishes\Repositories\DishRepository;

class DishesService
{
    public function __construct(
        private readonly DishRepository $dishRepository,
    ){
    }

    public function find(int $id): ?Dish
    {
        return $this->dishRepository->find($id);
    }

    public function store(StoreDishDTO $dto): Dish
    {
        return $this->dishRepository->store($dto);
    }

    public function update(Dish $dish, UpdateDishDTO $dto): Dish
    {
        return $this->dishRepository->update($dish, $dto);
    }

    public function delete(int $id): void
    {
        $this->dishRepository->delete($id);
    }
}
