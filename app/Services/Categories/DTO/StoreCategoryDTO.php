<?php

namespace App\Services\Categories\DTO;

class StoreCategoryDTO
{
    public function __construct(
        protected string $name,
        protected int $company_id,
    ){
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'company_id' => $this->getCompanyId(),
        ];
    }

    public static function fromArray(array $data): StoreCategoryDTO
    {
        return new self(
            $data['name'],
            $data['company_id'],
        );
    }
}
