<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UsersService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){
    }

    public function index(): Collection
    {
        return $this->userRepository->index();
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
