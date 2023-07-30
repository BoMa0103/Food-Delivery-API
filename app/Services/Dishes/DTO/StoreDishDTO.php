<?php

namespace App\Services\Dishes\DTO;

class StoreDishDTO
{
    public function __construct(
        protected string $name,
        protected ?string $description,
        protected float $price,
        protected ?string $image,
        protected int $category_id,
        protected int $package_id,
    ){
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getPackageId(): int
    {
        return $this->package_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
            'image' => $this->getImage(),
            'category_id' => $this->getCategoryId(),
            'package_id' => $this->getPackageId()
        ];
    }

    public static function fromArray(array $data): StoreDishDTO
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image'],
            $data['category_id'],
            $data['package_id'],
        );
    }
}
