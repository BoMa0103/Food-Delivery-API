<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\StoreOrderRequestDTO;
use Illuminate\Support\Facades\Log;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\DishGenerator;
use Tests\Generators\OrderGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class StoreOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $user = UserGenerator::generate();
        $dish = DishGenerator::generate();
        $dto = StoreOrderRequestDTO::fromArray(
            OrderGenerator::storeOrderRequestDTOArrayGenerate([
                'cart_items' => [
                        [
                            'id' => $dish->id,
                            'count' => fake()->numberBetween(1, 20),
                        ],
                    ],
                'company_id' => $dish->category->company_id,
                'user_id' => $user->id,
            ])
        );
        $response = $this->post(route('orders.store'), [
            'cart_items' => $dto->getCartItems(),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsForbidden(): void
    {
        $user = UserGenerator::generate();
        $dish = DishGenerator::generate();
        Log::info('sdf');
        $dto = StoreOrderRequestDTO::fromArray(
            OrderGenerator::storeOrderRequestDTOArrayGenerate([
                'cart_items' => [
                    [
                        'id' => $dish->id,
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ],
                'company_id' => $dish->category->company_id,
                'user_id' => $user->id,
            ])
        );
        $response = $this->post(route('orders.store'), [
            'cart_items' => $dto->getCartItems(),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
            'Accept' => 'application/json',
        ]);

        $response->assertForbidden();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $user = UserGenerator::generate();
        $dish = DishGenerator::generate();
        $dto = StoreOrderRequestDTO::fromArray(
            OrderGenerator::storeOrderRequestDTOArrayGenerate([
                'cart_items' => [
                    [
                        'id' => $dish->id,
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ],
                'company_id' => $dish->category->company_id,
                'user_id' => $user->id,
            ])
        );
        $response = $this->post(route('orders.store'), [
            'cart_items' => $dto->getCartItems(),
            'company_id' => $dto->getCompanyId(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $user = CompanyGenerator::generate();
        $dish = DishGenerator::generate();
        $dto = StoreOrderRequestDTO::fromArray(
            OrderGenerator::storeOrderRequestDTOArrayGenerate([
                'cart_items' => [
                    [
                        'id' => $dish->id,
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ],
                'company_id' => $dish->category->company_id,
                'user_id' => $user->id,
            ])
        );
        $response = $this->post(route('orders.store'), [
            'cart_items' => $dto->getCartItems(),
            'company_id' => Random::generate(2, 'a-z'),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StoreOrderRequestDTO::fromArray(
            OrderGenerator::storeOrderRequestDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
                'user_id' => Random::generate(4, '1-9'),
            ])
        );
        $response = $this->post(route('orders.store'), [
            'cart_items' => $dto->getCartItems(),
            'company_id' => $dto->getCompanyId(),
            'user_id' => $dto->getUserId(),
            'deliveryType' => $dto->getDeliveryType(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
