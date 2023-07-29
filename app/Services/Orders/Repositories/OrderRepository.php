<?php

namespace App\Services\Orders\Repositories;

use App\Models\Order;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\UpdateOrderDTO;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepository
{
    public function index(): Collection;
    public function find(int $id): ?Order;
    public function store(StoreOrderDTO $dto): Order;
    public function update(Order $order, UpdateOrderDTO $dto): Order;
    public function delete(int $id): void;
}
