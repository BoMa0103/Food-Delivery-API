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
        $dto = UpdateDishDTO::fromArray(
            DishGenerator::updateDishDTOArrayGenerate([
                'category_id' => $dish->category_id,
                'package_id'  => $dish->package_id,
            ])
        );
        $response = $this->put(route('dishes.update', ['dish' => $dish->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray(
            DishGenerator::updateDishDTOArrayGenerate([
                'category_id' => $dish->category_id,
                'package_id'  => $dish->package_id,
            ])
        );
        $response = $this->put(route('dishes.update', ['dish' => Random::generate(2, 'a-z')]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray(
            DishGenerator::updateDishDTOArrayGenerate([
                'category_id' => Random::generate(4, '1-9'),
                'package_id'  => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->put(route('dishes.update', ['dish' => $dish->id]), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
