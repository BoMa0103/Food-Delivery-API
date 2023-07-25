<?php

namespace App\Services\Orders\DTO;

class UpdateOrderDTO
{
    public function __construct(
        protected array $cart_items,
        protected int $company_id,
        protected int $user_id,
        protected int $deliveryType,
        protected int $deliveryTime,
    ){
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getDeliveryType(): int
    {
        return $this->deliveryType;
    }

    public function getDeliveryTime(): int
    {
        return $this->deliveryTime;
    }

    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    public function getCartItems(): array
    {
        return $this->cart_items;
    }

    public function toArray(): array
    {
        return [
            'cart_items' => $this->getCartItems(),
            'company_id' => $this->getCompanyId(),
            'user_id' => $this->getUserId(),
            'deliveryType' => $this->getDeliveryType(),
            'deliveryTime' => $this->getDeliveryTime(),
        ];
    }

    public static function fromArray(array $data): UpdateOrderDTO
    {
        return new self(
            json_decode($data['cart_items'], true),
            $data['company_id'],
            $data['user_id'],
            $data['deliveryType'],
            $data['deliveryTime'],
        );
    }
}
