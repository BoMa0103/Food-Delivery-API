<?php

namespace App\Services\Orders\Handlers;

use App\Models\Order;
use App\Services\Companies\CompaniesService;
use App\Services\Dishes\DishesService;
use App\Services\Orders\DTO\StoreOrderDTO;
use App\Services\Orders\DTO\StoreOrderRequestDTO;
use App\Services\Orders\OrdersService;
use App\Services\Packages\PackagesService;
use App\Services\Users\UsersService;
use Nette\Utils\Random;

class CreateOrderHandler
{
    public function __construct(
        private readonly OrdersService $ordersService,
        private readonly UsersService $usersService,
        private readonly PackagesService $packagesService,
        private readonly CompaniesService $companiesService,
        private readonly DishesService $dishesService,
    )
    {
    }

    public function handle(StoreOrderRequestDTO $orderDTO): ?Order
    {
        return $this->ordersService->store(
            $this->generateOrderData($orderDTO)
        );
    }

    private function generateOrderData(StoreOrderRequestDTO $orderDTO): StoreOrderDTO
    {
        return StoreOrderDTO::fromArray([
            'number' => $this->generateOrderNumber(),
            'cart_items' => json_encode($orderDTO->getCartItems()),
            'company_id' => $orderDTO->getCompanyId(),
            'user_id' => $orderDTO->getUserId(),
            'deliveryType' => $orderDTO->getDeliveryType(),
            'deliveryTime' => $orderDTO->getDeliveryTime(),
            'deliveryAddressStreet' => $orderDTO->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $orderDTO->getDeliveryAddressHouse(),
            'prices' => json_encode($this->generatePricesData($orderDTO)),
            'user' => json_encode($this->generateUserData($orderDTO)),
            'package' => json_encode($this->generatePackageData($orderDTO)),
        ]);
    }

    private function generateOrderNumber(): int
    {
        return Random::generate(6, '1-9');
    }

    private function generatePricesData(StoreOrderRequestDTO $orderDTO): array
    {
        $itemsPrice = $this->getItemsPrice($orderDTO->getCartItems());
        $packagePrice = $this->getPackagePrice($orderDTO);
        $deliveryPrice = $this->getDeliveryPrice();
        $fullPrice = $itemsPrice + $packagePrice + $deliveryPrice;

        return [
            'itemsPrice' => $itemsPrice,
            'packagePrice' => $packagePrice,
            'deliveryPrice' => $deliveryPrice,
            'fullPrice' => $fullPrice,
        ];
    }

    private function getItemsPrice(array $cartItems): float
    {
        $price = 0;
        foreach ($cartItems as $cartItem){
            $price += $this->dishesService->find($cartItem['id'])->price * $cartItem['count'];
        }
        return $price;
    }

    private function getDeliveryPrice(): float
    {
        return 0;
    }

    private function generateUserData(StoreOrderRequestDTO $orderDTO): array
    {
        return [
            'id' => $orderDTO->getUserId(),
            'name' => $this->getUserName($orderDTO->getUserId()),
            'email' => $this->getUserEmail($orderDTO->getUserId()),
        ];
    }

    private function getUserName(int $user_id): string
    {
        return $this->usersService->find($user_id)->name;
    }

    private function getUserEmail(int $user_id): string
    {
        return $this->usersService->find($user_id)->email;
    }

    private function generatePackageData(StoreOrderRequestDTO $orderDTO): array
    {
        return [
            'name' => $this->getPackageName($orderDTO),
            'price' => $this->getPackagePrice($orderDTO),
        ];
    }

    private function getPackageName(StoreOrderRequestDTO $orderDTO): string
    {
        $companyId = $orderDTO->getCompanyId();

        $company = $this->companiesService->find($companyId);

        return $this->packagesService->find($company->base_package_id)->name;
    }

    private function getPackagePrice(StoreOrderRequestDTO $orderDTO): float
    {
        $companyId = $orderDTO->getCompanyId();

        $company = $this->companiesService->find($companyId);

        return $this->packagesService->find($company->base_package_id)->price;
    }
}
