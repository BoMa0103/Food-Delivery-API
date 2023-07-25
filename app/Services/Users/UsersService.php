<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use App\Services\Users\Repositories\UserRepository;

class UsersService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){
    }

    public function find(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function store(StoreUserDTO $dto): User
    {
        return $this->userRepository->store($dto);
    }

    public function update(User $package, UpdateUserDTO $dto): User
    {
        return $this->userRepository->update($package, $dto);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }
}
