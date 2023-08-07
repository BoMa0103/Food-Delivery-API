<?php

namespace Tests\Feature\Http\Orders;

use Nette\Utils\Random;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class DeleteOrderControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $order = OrderGenerator::generate();
        $response = $this->delete(route('orders.delete', [
            'order' => $order->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $order = OrderGenerator::generate();
        $response = $this->delete(route('orders.delete', [
            'order' => $order->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testOrderDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('orders.delete', [
            'order' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('orders.delete', [
            'order' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNotFound();
    }
}
