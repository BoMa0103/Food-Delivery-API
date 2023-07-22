<?php

namespace Tests\Feature\Services\Orders\Repositories;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\UpdateOrderDTO;
use App\Services\Orders\Repositories\EloquentOrderRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\CompanyGenerator;
use Tests\Generators\OrderGenerator;
use Tests\TestCase;

class EloquentOrderRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentOrderRepository(): EloquentOrderRepository
    {
        return app(EloquentOrderRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = OrderGenerator::generate();
        $order = $this->getEloquentOrderRepository()->find($model->id);
        $this->assertNotNull($order);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $order = $this->getEloquentOrderRepository()->find($id);

        $this->assertNull($order);
    }

    public function testCreateExpectsSuccess():void
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
        $this->getEloquentOrderRepository()->store($dto);

        $model = Order::query()->where('number', $dto->getNumber())->first();
        $this->assertEquals($dto->getCartItems(), $model->cart_items);
        $this->assertEquals($dto->getCompanyId(), $model->company_id);
        $this->assertDatabaseCount('orders', 1);
    }

    public function testUpdateExpectsSuccess():void
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
        ]);
        $oldCompanyId = $order->company_id;
        $oldCartItems = $order->cart_items;
        $this->getEloquentOrderRepository()->update($order, $dto);

        $order->refresh();

        $this->assertEquals($oldCompanyId, $order->company_id);
        $this->assertNotEquals($oldCartItems, $order->cart_items);
    }

    public function testDeleteExpectsSuccess():void
    {
        $order = OrderGenerator::generate();
        $this->getEloquentOrderRepository()->delete($order->id);

        $this->assertNull($order->fresh());
        $this->assertDatabaseCount('orders', 0);
    }
}
