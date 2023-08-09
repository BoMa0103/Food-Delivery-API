<?php

namespace Tests\Feature\Http\Companies;

use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class ShowCompanyControllerTest extends TestCase
{
    public function testExpectsNotFound(): void
    {
        $company = CompanyGenerator::generate();
        $response = $this->get(route('companies.show', [
            'company' => $company->id,
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('companies.show', [
            'company' => Random::generate(4, '0-9'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('companies.show', [
            'company' => Random::generate(2, 'a-z'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
