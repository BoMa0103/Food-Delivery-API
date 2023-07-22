<?php

namespace App\Services\Orders\DTO;

class StoreOrderDTO
{
    public function __construct(
        protected int $number,
        protected array $cart_items,
        protected int $company_id,
    ){
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return array
     */
    public function getCartItems(): array
    {
        return $this->cart_items;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'number' => $this->getNumber(),
            'cart_items' => $this->getCartItems(),
            'company_id' => $this->getCompanyId(),
        ];
    }

    public static function fromArray(array $data): StoreOrderDTO
    {
        return new self(
            $data['number'],
            json_decode($data['cart_items'], true),
            $data['company_id'],
        );
    }
}
