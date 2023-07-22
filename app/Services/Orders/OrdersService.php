<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\UpdateOrderDTO;
use App\Services\Orders\Repositories\OrderRepository;

class OrdersService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
    ){
    }

    public function find(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    public function store(StoreOrderDTO $dto): Order
    {
        return $this->orderRepository->store($dto);
    }

    public function update(Order $order, UpdateOrderDTO $dto): Order
    {
        return $this->orderRepository->update($order, $dto);
    }

    public function delete(int $id): void
    {
        $this->orderRepository->delete($id);
    }
}
