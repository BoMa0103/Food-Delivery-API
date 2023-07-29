<?php

namespace App\Services\Companies;

use App\Models\Company;
use App\Services\Companies\DTO\StoreCompanyDTO;
use App\Services\Companies\DTO\UpdateCompanyDTO;
use App\Services\Companies\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;

class CompaniesService
{
    public function __construct(
        private readonly CompanyRepository $companyRepository,
    ){
    }

    public function index(): Collection
    {
        return $this->companyRepository->index();
    }

    public function find(int $id): ?Company
    {
        return $this->companyRepository->find($id);
    }

    public function store(StoreCompanyDTO $dto): Company
    {
        return $this->companyRepository->store($dto);
    }

    public function update(Company $company, UpdateCompanyDTO $dto): Company
    {
        return $this->companyRepository->update($company, $dto);
    }

    public function delete(int $id): void
    {
        $this->companyRepository->delete($id);
    }
}
