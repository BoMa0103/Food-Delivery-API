<?php

namespace Tests\Feature\Http\Orders;

use App\Services\Orders\DTO\StoreOrderDTO;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\TestCase;

class StoreOrderControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('orders.store'), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => $dto->getCompanyId(),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
    }

    public function testFieldDoesNotExistExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('orders.store'), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }

    public function testFieldTypeIsNotCorrectExpectsUnprocessable(): void
    {
        $model = CompanyGenerator::generate();
        $dto = StoreOrderDTO::fromArray([
            'number' => Random::generate(6, '1-9'),
            'cart_items' => json_encode([
                [
                    'id' => Random::generate(2, '0-9'),
                    'count' => Random::generate(2, '0-9'),
                ],
            ]),
            'company_id' => $model->id,
        ]);
        $response = $this->post(route('orders.store'), [
            'cart_items' => json_encode(
                $dto->getCartItems()
            ),
            'company_id' => Random::generate(2, 'a-z'),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertUnprocessable();
    }
}
