<?php

namespace Tests\Generators;

use App\Models\Category;
use App\Models\Company;
use App\Models\Dish;

class DishGenerator
{
    public static function generate(array $data = []): Dish
    {
        $company = Company::factory()->create();
        $category = Category::factory()->for($company)->create();
        return Dish::factory()->for($category)->create($data);
    }
}
