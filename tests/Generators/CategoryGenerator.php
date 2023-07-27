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

    public static function storeCategoryDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'company_id' => $data['company_id'] ?? null,
        ];
    }

    public static function updateCategoryDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'company_id' => $data['company_id'] ?? null,
        ];
    }
}
