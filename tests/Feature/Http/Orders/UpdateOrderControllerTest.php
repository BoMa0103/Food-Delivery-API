<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\UpdateOrderDTO;
use Nette\Utils\Random;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class UpdateOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $order = OrderGenerator::generate();
        $dto = UpdateOrderDTO::fromArray([
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $order->company_id,
            'user_id' => $order->user_id,
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
        ]);
        $response = $this->put(route('orders.update', ['order' => $order->id]), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $order = OrderGenerator::generate();
        $dto = UpdateOrderDTO::fromArray([
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $order->company_id,
            'user_id' => $order->user_id,
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
        ]);
        $response = $this->put(route('orders.update', ['order' => Random::generate(2, 'a-z')]), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }
}
