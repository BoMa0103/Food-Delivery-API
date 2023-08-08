<?php

namespace Tests\Feature\Http\Orders;

use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class IndexOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            OrderGenerator::generate();
        }

        $response = $this->get(route('orders.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            OrderGenerator::generate();
        }

        $response = $this->get(route('orders.index'));

        $response->assertUnauthorized();
    }
}
