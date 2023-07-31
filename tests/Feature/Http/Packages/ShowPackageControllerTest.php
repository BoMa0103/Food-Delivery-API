<?php

namespace Tests\Feature\Http\Packages;

use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class ShowPackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $response = $this->get(route('packages.show', [
            'package' => $category->id,
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('packages.show', [
            'package' => Random::generate(2, '0-9'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('packages.show', [
            'package' => Random::generate(2, 'a-z'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
