<?php

namespace App\Services\Packages\Repositories;

use App\Models\Package;
use app\Services\Packages\DTO\StorePackageDTO;
use app\Services\Packages\DTO\UpdatePackageDTO;
use Illuminate\Database\Eloquent\Collection;

interface PackageRepository
{
    public function index(): Collection;
    public function find(int $id): ?Package;
    public function store(StorePackageDTO $dto): Package;
    public function update(Package $company, UpdatePackageDTO $dto): Package;
    public function delete(int $id): void;
}
