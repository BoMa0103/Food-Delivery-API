<?php

namespace Tests\Feature\Http\Categories;

use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class DeleteCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $response = $this->delete(route('categories.delete', [
            'category' => $category->id,
        ]));

        $response->assertNoContent();
    }

    public function testOrderDoesNotExistExpectsSuccess(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(2, '0-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsSuccess(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
