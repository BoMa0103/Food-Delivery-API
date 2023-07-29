<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderRequestDTO;
use App\Services\Orders\DTO\UpdateOrderRequestDTO;
use App\Services\Orders\Handlers\CreateOrderHandler;
use App\Services\Orders\Handlers\UpdateOrderHandler;
use App\Services\Orders\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class OrdersService
{
    public function __construct(
        private readonly OrderRepository    $orderRepository,
        private readonly CreateOrderHandler $createOrderHandler,
        private readonly UpdateOrderHandler $updateOrderHandler,
    )
    {
    }

    public function index(): Collection
    {
        return $this->orderRepository->index();
    }

    public function find(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    public function store(StoreOrderRequestDTO $dto): Order
    {
        return $this->createOrderHandler->handle($dto);
    }

    public function update(Order $order, UpdateOrderRequestDTO $dto): Order
    {
        return $this->updateOrderHandler->handle($order, $dto);
    }

    public function delete(int $id): void
    {
        $this->orderRepository->delete($id);
    }
}
