<?php

namespace App\Services\Orders\Repositories;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\UpdateOrderDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository implements OrderRepository
{
    public function index(): Collection
    {
        return Order::query()->get();
    }

    public function find(int $id): ?Order
    {
        return Order::query()->find($id);
    }

    public function store(StoreOrderDTO $dto): Order
    {
        return Order::query()->create($dto->toArray());
    }

    public function update(Order $order, UpdateOrderDTO $dto): Order
    {
        $order->fill($dto->toArray())->save();

        return $order;
    }

    public function delete(int $id): void
    {
        Order::destroy($id);
    }
}
