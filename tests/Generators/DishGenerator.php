<?php

namespace Tests\Generators;

use App\Models\Category;
use App\Models\Company;
use App\Models\Dish;
use App\Models\Package;

class DishGenerator
{
    public static function generate(array $data = []): Dish
    {
        $company = Company::factory()->create();
        $category = Category::factory()->for($company)->create();
        $package = Package::factory()->for($company)->create();
        $company->setAttribute('base_package_id', $package->id);
        $company->save();
        return Dish::factory()->for($category)->for($package)->create($data);
    }

    public static function storeDishDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'description' => $data['description'] ?? fake()->text,
            'price' => $data['price'] ?? fake()->randomFloat(2, 1, 1000),
            'image' => $data['image'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'package_id' => $data['package_id'] ?? null,
        ];
    }

    public static function updateDishDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'description' => $data['description'] ?? fake()->text,
            'price' => $data['price'] ?? fake()->randomFloat(2, 1, 1000),
            'image' => $data['image'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'package_id' => $data['package_id'] ?? null,
        ];
    }
}
