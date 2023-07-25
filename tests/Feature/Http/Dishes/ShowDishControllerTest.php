<?php

namespace Tests\Feature\Http\Dishes;

use Nette\Utils\Random;
use Tests\Generators\DishGenerator;
use Tests\TestCase;

class ShowDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $dish = DishGenerator::generate();
        $response = $this->get(route('dishes.show', [
            'dish' => $dish->id,
        ]));

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('dishes.show', [
            'dish' => Random::generate(2, '0-9'),
        ]));

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('dishes.show', [
            'dish' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
