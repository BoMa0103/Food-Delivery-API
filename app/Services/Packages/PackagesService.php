<?php

namespace App\Services\Packages;

use App\Models\Package;
use app\Services\Packages\DTO\StorePackageDTO;
use app\Services\Packages\DTO\UpdatePackageDTO;
use App\Services\Packages\Repositories\PackageRepository;
use Illuminate\Database\Eloquent\Collection;

class PackagesService
{
    public function __construct(
        private readonly PackageRepository $packageRepository,
    ){
    }

    public function index(): Collection
    {
        return $this->packageRepository->index();
    }

    public function find(int $id): ?Package
    {
        return $this->packageRepository->find($id);
    }

    public function store(StorePackageDTO $dto): Package
    {
        return $this->packageRepository->store($dto);
    }

    public function update(Package $package, UpdatePackageDTO $dto): Package
    {
        return $this->packageRepository->update($package, $dto);
    }

    public function delete(int $id): void
    {
        $this->packageRepository->delete($id);
    }
}
