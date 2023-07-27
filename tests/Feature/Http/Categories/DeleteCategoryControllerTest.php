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

    public function testCategoryDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(4, '1-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
