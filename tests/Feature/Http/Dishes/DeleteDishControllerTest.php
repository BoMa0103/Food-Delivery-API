<?php

namespace Tests\Feature\Http\Dishes;

use Nette\Utils\Random;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class DeleteDishControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $dish = DishGenerator::generate();
        $response = $this->delete(route('dishes.delete', [
            'dish' => $dish->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $dish = DishGenerator::generate();
        $response = $this->delete(route('dishes.delete', [
            'dish' => $dish->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testDishDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('dishes.delete', [
            'dish' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('dishes.delete', [
            'dish' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateAdminBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
