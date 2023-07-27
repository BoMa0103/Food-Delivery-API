<?php

namespace App\Services\Packages\DTO;

class StorePackageDTO
{
    public function __construct(
        protected string $name,
        protected float  $price,
        protected string $description,
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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'description' => $this->getDescription(),
            'company_id' => $this->getCompanyId(),
        ];
    }

    public static function fromArray(array $data): StorePackageDTO
    {
        return new self(
            $data['name'],
            $data['price'],
            $data['description'],
            $data['company_id'],
        );
    }
}
