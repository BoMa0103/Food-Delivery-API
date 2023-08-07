<?php

namespace Tests\Feature\Http\Companies;

use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class DeleteCompanyControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $company = CompanyGenerator::generate();
        $response = $this->delete(route('companies.delete', [
            'company' => $company->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $company = CompanyGenerator::generate();
        $response = $this->delete(route('companies.delete', [
            'company' => $company->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testCompanyDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('companies.delete', [
            'company' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('companies.delete', [
            'company' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNotFound();
    }
}
