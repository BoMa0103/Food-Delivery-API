<?php

namespace App\Services\Dishes\DTO;

class UpdateDishDTO
{
    public function __construct(
        protected string $name,
        protected string $description,
        protected float $price,
        protected int $category_id,
    ){
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
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
    public function getDescription(): string
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
            'category_id' => $this->getCategoryId(),
        ];
    }

    public static function fromArray(array $data): UpdateDishDTO
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['price'],
            $data['category_id'],
        );
    }
}
