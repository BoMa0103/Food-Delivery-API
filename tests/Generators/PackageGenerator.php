<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Package;

class PackageGenerator
{
    public static function generate(Company $company = null, array $data = []): Package
    {
        if ($company) {
            return Package::factory()->for($company)->create($data);
        }

        $company = Company::factory()->create();
        return Package::factory()->for($company)->create($data);
    }

    public static function storePackageDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'price' => $data['price'] ?? fake()->randomFloat(2, 1, 1000),
            'description' => $data['description'] ?? fake()->text,
            'company_id' => $data['company_id'] ?? null
        ];
    }

    public static function updatePackageDTOArrayGenerate(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? fake()->name,
            'price' => $data['price'] ?? fake()->randomFloat(2, 1, 1000),
            'description' => $data['description'] ?? fake()->text,
            'company_id' => $data['company_id'] ?? null
        ];
    }
}
