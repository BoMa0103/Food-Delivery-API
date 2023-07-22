<?php

namespace App\Services\Companies\Repositories;

use App\Models\Company;
use App\Services\Companies\DTO\StoreCompanyDTO;
use App\Services\Companies\DTO\UpdateCompanyDTO;

interface CompanyRepository
{
    public function find(int $id): ?Company;
    public function store(StoreCompanyDTO $dto): Company;
    public function update(Company $company, UpdateCompanyDTO $dto): Company;
    public function delete(int $id): void;
}
