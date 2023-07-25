<?php

namespace Tests\Feature\Http\Orders;

use Nette\Utils\Random;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class ShowOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $order = OrderGenerator::generate();
        $response = $this->get(route('orders.show', [
            'order' => $order->id,
        ]));

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('orders.show', [
            'order' => Random::generate(2, '0-9'),
        ]));

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('orders.show', [
            'order' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
