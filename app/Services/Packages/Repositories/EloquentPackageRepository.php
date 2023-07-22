<?php

namespace App\Services\Packages\Repositories;

use App\Models\Package;
use app\Services\Packages\DTO\StorePackageDTO;
use app\Services\Packages\DTO\UpdatePackageDTO;

class EloquentPackageRepository implements PackageRepository
{
    public function find(int $id): ?Package
    {
        return Package::query()->find($id);
    }

    public function store(StorePackageDTO $dto): Package
    {
        return Package::query()->create($dto->toArray());
    }

    public function update(Package $package, UpdatePackageDTO $dto): Package
    {
        $package->fill($dto->toArray())->save();

        return $package;
    }

    public function delete(int $id): void
    {
        Package::destroy($id);
    }
}
