<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function index(): Collection;
    public function find(int $id): ?User;
    public function store(StoreUserDTO $dto): User;
    public function update(User $user, UpdateUserDTO $dto): User;
    public function delete(int $id): void;
}
