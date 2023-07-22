<?php

namespace Tests\Generators;

use App\Models\Category;
use App\Models\Company;

class CategoryGenerator
{
    public static function generate(array $data = []): Category
    {
        $company = Company::factory()->create();
        return Category::factory()->for($company)->create($data);
    }
}
