<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\StoreOrderDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\OrderGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class StoreOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $company = CompanyGenerator::generate();
        $user = UserGenerator::generate();
        $dto = StoreOrderDTO::fromArray(
            OrderGenerator::storeOrderDTOArrayGenerate([
                'company_id' => $company->id,
                'user_id' => $user->id,
            ])
        );
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
        $dto = StoreOrderDTO::fromArray(
            OrderGenerator::storeOrderDTOArrayGenerate([
                'company_id' => $company->id,
                'user_id' => $user->id,
            ])
        );
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
        $dto = StoreOrderDTO::fromArray(
            OrderGenerator::storeOrderDTOArrayGenerate([
                'company_id' => $company->id,
                'user_id' => $user->id,
            ])
        );
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
        $dto = StoreOrderDTO::fromArray(
            OrderGenerator::storeOrderDTOArrayGenerate([
                'company_id' => Random::generate(4, '1-9'),
                'user_id' => Random::generate(4, '1-9'),
            ])
        );
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
