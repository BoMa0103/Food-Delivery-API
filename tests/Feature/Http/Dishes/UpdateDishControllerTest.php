<?php

namespace Tests\Feature\Http\Dishes;

use App\Services\Dishes\DTO\UpdateDishDTO;
use Nette\Utils\Random;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class UpdateDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $dish->category_id,
        ]);
        $response = $this->put(route('dishes.update', ['dish' => $dish->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $dish->category_id,
        ]);
        $response = $this->put(route('dishes.update', ['dish' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => Random::generate(2, '1-9'),
        ]);
        $response = $this->put(route('dishes.update', ['dish' => $dish->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
