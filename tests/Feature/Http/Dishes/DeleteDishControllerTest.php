<?php

namespace Tests\Feature\Http\Dishes;

use Nette\Utils\Random;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class DeleteDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dish = DishGenerator::generate();
        $response = $this->delete(route('dishes.delete', [
            'dish' => $dish->id,
        ]));

        $response->assertNoContent();
    }

    public function testDishDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('dishes.delete', [
            'dish' => Random::generate(2, '0-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('dishes.delete', [
            'dish' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
