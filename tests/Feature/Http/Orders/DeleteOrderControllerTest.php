<?php

namespace Tests\Feature\Http\Orders;

use Nette\Utils\Random;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class DeleteOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $order = OrderGenerator::generate();
        $response = $this->delete(route('orders.delete', [
            'order' => $order->id,
        ]));

        $response->assertNoContent();
    }

    public function testOrderDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('orders.delete', [
            'order' => Random::generate(4, '1-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('orders.delete', [
            'order' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
