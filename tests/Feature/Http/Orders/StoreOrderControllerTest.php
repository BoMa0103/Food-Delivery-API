<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\StoreOrderDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class StoreOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $company = CompanyGenerator::generate();
        $user = UserGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $company->id,
            'user_id' => $user->id,
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => Random::generate(10, 'a-z'),
            'deliveryAddressHouse' => Random::generate(10, 'a-z'),
        ]);
        $response = $this->post(route('orders.store'), [
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

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $company = CompanyGenerator::generate();
        $user = UserGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $company->id,
            'user_id' => $user->id,
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => Random::generate(10, 'a-z'),
            'deliveryAddressHouse' => Random::generate(10, 'a-z'),
        ]);
        $response = $this->post(route('orders.store'), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
            'deliveryTime' => $dto->getDeliveryTime(),
            'deliveryAddressStreet' => $dto->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $dto->getDeliveryAddressHouse(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $company = CompanyGenerator::generate();
        $user = CompanyGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $company->id,
            'user_id' => $user->id,
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => Random::generate(10, 'a-z'),
            'deliveryAddressHouse' => Random::generate(10, 'a-z'),
        ]);
        $response = $this->post(route('orders.store'), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => Random::generate(2, 'a-z'),
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

    public function testForeignKeyDoesNotExistsExpectsUnprocessable(): void
    {
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => Random::generate(2, '1-9'),
            'user_id' => Random::generate(2, '1-9'),
            'deliveryType' => Random::generate(1, '1-2'),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => Random::generate(10, 'a-z'),
            'deliveryAddressHouse' => Random::generate(10, 'a-z'),
        ]);
        $response = $this->post(route('orders.store'), [
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
