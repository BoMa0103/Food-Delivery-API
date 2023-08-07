<?php

namespace Tests\Feature\Http\Categories;

use Nette\Utils\Random;
use Tests\Generators\CategoryGenerator;
use Tests\TestCase;

class DeleteCategoryControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $category = CategoryGenerator::generate();
        $response = $this->delete(route('categories.delete', [
            'category' => $category->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $category = CategoryGenerator::generate();
        $response = $this->delete(route('categories.delete', [
            'category' => $category->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testCategoryDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('categories.delete', [
            'category' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNotFound();
    }
}
