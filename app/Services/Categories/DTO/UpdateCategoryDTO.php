<?php

namespace App\Services\Categories\DTO;

class UpdateCategoryDTO
{
    public function __construct(
        protected string $name,
        protected int    $company_id,
    )
    {
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

    /**
     * @param array $data
     * @return UpdateCategoryDTO
     */
    public static function fromArray(array $data): UpdateCategoryDTO
    {
        return new self(
            $data['name'],
            $data['company_id'],
        );
    }
}
