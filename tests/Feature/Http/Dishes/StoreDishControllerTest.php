<?php

namespace Tests\Feature\Http\Dishes;

use App\Services\Dishes\DTO\StoreDishDTO;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class StoreDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CategoryGenerator::generate();
        $dto = StoreDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $model->id,
        ]);
        $response = $this->post(route('dishes.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $model = CategoryGenerator::generate();
        $dto = StoreDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $model->id,
        ]);
        $response = $this->post(route('dishes.store'), [
            'description' => $dto->getDescription(),
            'category_id' => $dto->getCategoryId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CategoryGenerator::generate();
        $dto = StoreDishDTO::fromArray([
            'name' => Random::generate(6, 'a-z'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $model->id,
        ]);
        $response = $this->post(route('dishes.store'), [
            'description' => $dto->getDescription(),
            'category_id' => Random::generate(1, 'a-z'),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
