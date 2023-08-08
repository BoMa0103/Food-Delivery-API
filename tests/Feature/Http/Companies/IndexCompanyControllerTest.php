<?php

namespace Tests\Feature\Http\Companies;

use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class IndexCompanyControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            CompanyGenerator::generate();
        }

        $response = $this->get(route('companies.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            CompanyGenerator::generate();
        }

        $response = $this->get(route('companies.index'));

        $response->assertUnauthorized();
    }
}
