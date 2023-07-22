<?php

namespace App\Services\Orders\Repositories;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\UpdateOrderDTO;

interface OrderRepository
{
    public function find(int $id): ?Order;
    public function store(StoreOrderDTO $dto): Order;
    public function update(Order $order, UpdateOrderDTO $dto): Order;
    public function delete(int $id): void;
}
