<?php

namespace App\Services\Companies\Repositories;

use App\Models\Company;
use App\Services\Companies\DTO\StoreCompanyDTO;
use App\Services\Companies\DTO\UpdateCompanyDTO;

class EloquentCompanyRepository implements CompanyRepository
{
    public function find(int $id): ?Company
    {
        return Company::query()->find($id);
    }

    public function store(StoreCompanyDTO $dto): Company
    {
        return Company::query()->create($dto->toArray());
    }

    public function update(Company $company, UpdateCompanyDTO $dto): Company
    {
        $company->fill($dto->toArray())->save();

        return $company;
    }

    public function delete(int $id): void
    {
        Company::destroy($id);
    }
}
