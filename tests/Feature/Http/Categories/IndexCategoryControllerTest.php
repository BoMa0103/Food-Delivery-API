<?php

namespace Tests\Feature\Http\Categories;

use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class IndexCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            CategoryGenerator::generate();
        }

        $response = $this->get(route('categories.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            CategoryGenerator::generate();
        }

        $response = $this->get(route('categories.index'));

        $response->assertUnauthorized();
    }
}
