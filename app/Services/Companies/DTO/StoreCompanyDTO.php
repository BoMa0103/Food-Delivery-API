<?php

namespace App\Services\Companies\DTO;

class StoreCompanyDTO
{
    public function __construct(
        protected string $name,
        protected string $address,
        protected float  $rating,
        protected int    $status,
        protected string $description,
        protected ?int    $base_order_package_id,
    )
    {
    }

    /**
     * @return ?int
     */
    public function getBaseOrderPackageId(): ?int
    {
        return $this->base_order_package_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
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
            'address' => $this->getAddress(),
            'rating' => $this->getRating(),
            'status' => $this->getStatus(),
            'description' => $this->getDescription(),
            'base_order_package_id' => $this->getBaseOrderPackageId(),
        ];
    }

    public static function fromArray(array $data): StoreCompanyDTO
    {
        return new self(
            $data['name'],
            $data['address'],
            $data['rating'],
            $data['status'],
            $data['description'],
            $data['base_order_package_id'],
        );
    }
}
