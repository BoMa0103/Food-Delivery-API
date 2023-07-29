<?php

namespace App\Services\Orders\DTO;

class StoreOrderDTO
{
    public function __construct(
        protected int    $number,
        protected array  $cart_items,
        protected int    $company_id,
        protected int    $user_id,
        protected int    $deliveryType,
        protected int    $deliveryTime,
        protected string $deliveryAddressStreet,
        protected string $deliveryAddressHouse,
        protected array  $prices,
        protected array  $user,
        protected array  $package,
    )
    {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
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
     * @return int
     */
    public function getDeliveryType(): int
    {
        return $this->deliveryType;
    }

    /**
     * @return int
     */
    public function getDeliveryTime(): int
    {
        return $this->deliveryTime;
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

    /**
     * @return array
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getPackage(): array
    {
        return $this->package;
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
            'user_id' => $this->getUserId(),
            'deliveryType' => $this->getDeliveryType(),
            'deliveryTime' => $this->getDeliveryTime(),
            'deliveryAddressStreet' => $this->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $this->getDeliveryAddressHouse(),
            'prices' => $this->getPrices(),
            'user' => $this->getUser(),
            'package' => $this->getPackage(),
        ];
    }

    public static function fromArray(array $data): StoreOrderDTO
    {
        return new self(
            $data['number'],
            $data['cart_items'],
            $data['company_id'],
            $data['user_id'],
            $data['deliveryType'],
            $data['deliveryTime'],
            $data['deliveryAddressStreet'],
            $data['deliveryAddressHouse'],
            $data['prices'],
            $data['user'],
            $data['package'],
        );
    }
}
