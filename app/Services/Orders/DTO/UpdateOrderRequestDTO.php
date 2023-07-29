<?php

namespace App\Services\Orders\DTO;

class UpdateOrderRequestDTO
{
    public function __construct(
        protected array  $cart_items,
        protected int    $company_id,
        protected int    $user_id,
        protected int    $deliveryType,
        protected int    $deliveryTime,
        protected string $deliveryAddressStreet,
        protected string $deliveryAddressHouse,
    )
    {
    }

    /**
     * @return string
     */
    public function getDeliveryAddressStreet(): string
    {
        return $this->deliveryAddressStreet;
    }

    /**
     * @return string
     */
    public function getDeliveryAddressHouse(): string
    {
        return $this->deliveryAddressHouse;
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
            'deliveryAddressStreet' => $this->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $this->getDeliveryAddressHouse(),
        ];
    }

    public static function fromArray(array $data): UpdateOrderRequestDTO
    {
        return new self(
            $data['cart_items'],
            $data['company_id'],
            $data['user_id'],
            $data['deliveryType'],
            $data['deliveryTime'],
            $data['deliveryAddressStreet'],
            $data['deliveryAddressHouse'],
        );
    }
}
