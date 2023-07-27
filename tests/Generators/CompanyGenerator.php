<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Package;

class CompanyGenerator
{
    public static function generate(array $data = []): Company
    {
        return Company::factory()->create($data);
    }

    public static function storeCompanyDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'address' => $data['address'] ?? fake()->address,
            'rating' => $data['rating'] ?? fake()->numberBetween(1,5),
            'status' => $data['status'] ?? fake()->numberBetween(1,3),
            'description' => $data['description'] ?? fake()->text,
            'base_order_package_id' => $data['base_order_package_id'] ?? null,
        ];
    }

    public static function updateCompanyDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'address' => $data['address'] ?? fake()->address,
            'rating' => $data['rating'] ?? fake()->numberBetween(1,5),
            'status' => $data['status'] ?? fake()->numberBetween(1,3),
            'description' => $data['description'] ?? fake()->text,
            'base_order_package_id' => $data['base_order_package_id'] ?? null,
        ];
    }
}
