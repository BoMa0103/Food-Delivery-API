<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;

interface UserRepository
{
    public function find(int $id): ?User;
    public function store(StoreUserDTO $dto): User;
    public function update(User $user, UpdateUserDTO $dto): User;
    public function delete(int $id): void;
}
