<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Package;

class PackageGenerator
{
    public static function generate(array $data = []): Package
    {
        $company = Company::factory()->create();
        return Package::factory()->for($company)->create($data);
    }
}
