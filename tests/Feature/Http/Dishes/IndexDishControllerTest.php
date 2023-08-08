<?php

namespace Tests\Feature\Http\Dishes;

use Tests\Generators\DishGenerator;
use Tests\TestCase;

class IndexDishControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DishGenerator::generate();
        }

        $response = $this->get(route('dishes.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DishGenerator::generate();
        }

        $response = $this->get(route('dishes.index'));

        $response->assertUnauthorized();
    }
}
