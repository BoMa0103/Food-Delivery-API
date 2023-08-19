<?php

namespace Tests\Feature\Http\Dishes;

use App\Services\Dishes\DTO\StoreDishDTO;
use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\Generators\DishGenerator;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class StoreDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $package = PackageGenerator::generate();
        $dto = StoreDishDTO::fromArray(
            DishGenerator::storeDishDTOArrayGenerate([
                'category_id' => $category->id,
                'package_id'  => $package->id,
            ])
        );
        $response = $this->post(route('dishes.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsForbidden(): void
    {
        $category = CategoryGenerator::generate();
        $package = PackageGenerator::generate();
        $dto = StoreDishDTO::fromArray(
            DishGenerator::storeDishDTOArrayGenerate([
                'category_id' => $category->id,
                'package_id'  => $package->id,
            ])
        );
        $response = $this->post(route('dishes.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertForbidden();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $category = CategoryGenerator::generate();
        $package = PackageGenerator::generate();
        $dto = StoreDishDTO::fromArray(
            DishGenerator::storeDishDTOArrayGenerate([
                'category_id' => $category->id,
                'package_id'  => $package->id,
            ])
        );
        $response = $this->post(route('dishes.store'), [
            'description' => $dto->getDescription(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $category = CategoryGenerator::generate();
        $package = PackageGenerator::generate();
        $dto = StoreDishDTO::fromArray(
            DishGenerator::storeDishDTOArrayGenerate([
                'category_id' => $category->id,
                'package_id'  => $package->id,
            ])
        );
        $response = $this->post(route('dishes.store'), [
            'description' => $dto->getDescription(),
            'category_id' => Random::generate(2, 'a-z'),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StoreDishDTO::fromArray(
            DishGenerator::storeDishDTOArrayGenerate([
                'category_id' => Random::generate(4, '1-9'),
                'package_id'  => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->post(route('categories.store'), [
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
            'category_id' => $dto->getCategoryId(),
            'package_id' => $dto->getPackageId(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
