<?php

namespace Tests\Feature\Http\Companies;

use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class DeleteCompanyControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $company = CompanyGenerator::generate();
        $response = $this->delete(route('companies.delete', [
            'company' => $company->id,
        ]));

        $response->assertNoContent();
    }

    public function testOrderDoesNotExistExpectsSuccess(): void
    {
        $response = $this->delete(route('companies.delete', [
            'company' => Random::generate(2, '0-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsSuccess(): void
    {
        $response = $this->delete(route('companies.delete', [
            'company' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
