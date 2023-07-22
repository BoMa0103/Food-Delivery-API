<?php

namespace App\Services\Orders\DTO;

class UpdateOrderDTO
{
    public function __construct(
        protected array $cart_items,
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
     * @return array
     */
    public function getCartItems(): array
    {
        return $this->cart_items;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'cart_items' => $this->getCartItems(),
            'company_id' => $this->getCompanyId(),
        ];
    }

    public static function fromArray(array $data): UpdateOrderDTO
    {
        return new self(
            json_decode($data['cart_items'], true),
            $data['company_id'],
        );
    }
}
