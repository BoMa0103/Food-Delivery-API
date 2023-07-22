<?php

namespace Tests\Feature\Services\Dishes\Repositories;

use App\Models\Dish;
use App\Services\Dishes\DTO\StoreDishDTO;
use App\Services\Dishes\DTO\UpdateDishDTO;
use App\Services\Dishes\Repositories\EloquentDishRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class EloquentDishRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentDishRepository(): EloquentDishRepository
    {
        return app(EloquentDishRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = DishGenerator::generate();
        $order = $this->getEloquentDishRepository()->find($model->id);
        $this->assertNotNull($order);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $order = $this->getEloquentDishRepository()->find($id);

        $this->assertNull($order);
    }

    public function testCreateExpectsSuccess():void
    {
        $model = CategoryGenerator::generate();
        $dto = StoreDishDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $model->id,
        ]);
        $this->getEloquentDishRepository()->store($dto);

        $model = Dish::query()->where('name', $dto->getName())->first();
        $this->assertEquals($dto->getDescription(), $model->description);
        $this->assertEquals($dto->getPrice(), $model->price);
        $this->assertEquals($dto->getCategoryId(), $model->category_id);
        $this->assertDatabaseCount('dishes', 1);
    }

    public function testUpdateExpectsSuccess():void
    {
        $dish = DishGenerator::generate();
        $dto = UpdateDishDTO::fromArray([
            'name' => Random::generate(6, '1-9'),
            'description' => Random::generate(20, 'a-z'),
            'price' => Random::generate(3, '0-9'),
            'category_id' => $dish->category_id,
        ]);
        $oldCategoryId = $dish->category_id;
        $oldName = $dish->name;
        $oldPrice = $dish->price;
        $this->getEloquentDishRepository()->update($dish, $dto);

        $dish->refresh();

        $this->assertEquals($oldCategoryId, $dish->category_id);
        $this->assertNotEquals($oldName, $dish->name);
        $this->assertNotEquals($oldPrice, $dish->price);
    }

    public function testDeleteExpectsSuccess():void
    {
        $dish = DishGenerator::generate();
        $this->getEloquentDishRepository()->delete($dish->id);

        $this->assertNull($dish->fresh());
        $this->assertDatabaseCount('dishes', 0);
    }
}
