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
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsNotFound(): void
    {
        $response = $this->get(route('orders.show', [
            'order' => Random::generate(2, '0-9'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('orders.show', [
            'order' => Random::generate(2, 'a-z'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
