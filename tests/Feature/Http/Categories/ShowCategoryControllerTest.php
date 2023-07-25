<?php

namespace Tests\Feature\Http\Categories;

use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class ShowCategoryControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = CategoryGenerator::generate();
        $response = $this->get(route('categories.show', [
            'category' => $category->id,
        ]));

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('categories.show', [
            'category' => Random::generate(2, '0-9'),
        ]));

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('categories.show', [
            'category' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
