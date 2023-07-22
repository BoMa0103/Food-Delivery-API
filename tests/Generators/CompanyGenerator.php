<?php

namespace Tests\Generators;

use App\Models\Company;

class CompanyGenerator
{
    public static function generate(array $data = []): Company
    {
        return Company::factory()->create($data);
    }
}
