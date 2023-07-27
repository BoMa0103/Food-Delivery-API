<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\UpdateOrderRequestDTO;
use Nette\Utils\Random;
use Tests\Generators\DishGenerator;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class UpdateOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $order = OrderGenerator::generate();
        $dish = DishGenerator::generate();
        $dto = UpdateOrderRequestDTO::fromArray(
            OrderGenerator::updateOrderRequestDTOArrayGenerate([
                'cart_items' => json_encode([
                    [
                        'id' => $dish->id,
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
                'company_id' => $order->company_id,
                'user_id' => $order->user_id,
            ])
        );
        $response = $this->put(route('orders.update', ['order' => $order->id]), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $order = OrderGenerator::generate();
        $dish = DishGenerator::generate();
        $dto = UpdateOrderRequestDTO::fromArray(
            OrderGenerator::updateOrderRequestDTOArrayGenerate([
                'cart_items' => json_encode([
                    [
                        'id' => $dish->id,
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
                'company_id' => $order->company_id,
                'user_id' => $order->user_id,
            ])
        );
        $response = $this->put(route('orders.update', ['order' => Random::generate(2, 'a-z')]), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertNotFound();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $order = OrderGenerator::generate();
        $dto = UpdateOrderRequestDTO::fromArray(
            OrderGenerator::updateOrderRequestDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
                'user_id' => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->put(route('orders.update', ['order' => $order->id]), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
