<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;

class EloquentUserRepository implements UserRepository
{
    public function find(int $id): ?User
    {
        return User::query()->find($id);

    }

    public function store(StoreUserDTO $dto): User
    {
        return User::query()->create($dto->toArray());
    }

    public function update(User $user, UpdateUserDTO $dto): User
    {
        $user->fill($dto->toArray())->save();

        return $user;
    }

    public function delete(int $id): void
    {
        User::destroy($id);
    }
}
