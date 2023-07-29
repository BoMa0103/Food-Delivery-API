<?php

namespace App\Services\Orders\Handlers;

use App\Models\Order;
use App\Services\Companies\CompaniesService;
use App\Services\Dishes\DishesService;
use App\Services\Orders\DTO\UpdateOrderDTO;
use App\Services\Orders\DTO\UpdateOrderRequestDTO;
use App\Services\Orders\Repositories\OrderRepository;
use App\Services\Packages\PackagesService;
use App\Services\Users\UsersService;
use Nette\Utils\Random;

class UpdateOrderHandler
{
    public function __construct(
        private readonly OrderRepository  $orderRepository,
        private readonly UsersService     $usersService,
        private readonly PackagesService  $packagesService,
        private readonly CompaniesService $companiesService,
        private readonly DishesService    $dishesService,
    )
    {
    }

    public function handle(Order $order, UpdateOrderRequestDTO $orderDTO): ?Order
    {
        return $this->orderRepository->update(
            $order,
            $this->generateOrderData($orderDTO)
        );
    }

    private function generateOrderData(UpdateOrderRequestDTO $orderDTO): UpdateOrderDTO
    {
        return UpdateOrderDTO::fromArray([
            'number' => $this->generateOrderNumber(),
            'cart_items' => $orderDTO->getCartItems(),
            'company_id' => $orderDTO->getCompanyId(),
            'user_id' => $orderDTO->getUserId(),
            'deliveryType' => $orderDTO->getDeliveryType(),
            'deliveryTime' => $orderDTO->getDeliveryTime(),
            'deliveryAddressStreet' => $orderDTO->getDeliveryAddressStreet(),
            'deliveryAddressHouse' => $orderDTO->getDeliveryAddressHouse(),
            'prices' => $this->generatePricesData($orderDTO),
            'user' => $this->generateUserData($orderDTO),
            'package' => $this->generatePackageData($orderDTO),
        ]);
    }

    private function generateOrderNumber(): int
    {
        return Random::generate(6, '1-9');
    }

    private function generatePricesData(UpdateOrderRequestDTO $orderDTO): array
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
        foreach ($cartItems as $cartItem) {
            $price += $this->dishesService->find($cartItem['id'])->price * $cartItem['count'];
        }
        return $price;
    }

    private function getDeliveryPrice(): float
    {
        return 0;
    }

    private function generateUserData(UpdateOrderRequestDTO $orderDTO): array
    {
        return [
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

    private function generatePackageData(UpdateOrderRequestDTO $orderDTO): array
    {
        return [
            'name' => $this->getPackageName($orderDTO),
            'price' => $this->getPackagePrice($orderDTO),
        ];
    }

    private function getPackageName(UpdateOrderRequestDTO $orderDTO): string
    {
        $companyId = $orderDTO->getCompanyId();

        $company = $this->companiesService->find($companyId);

        return $this->packagesService->find($company->base_package_id)->name;
    }

    private function getPackagePrice(UpdateOrderRequestDTO $orderDTO): float
    {
        $companyId = $orderDTO->getCompanyId();

        $company = $this->companiesService->find($companyId);

        return $this->packagesService->find($company->base_package_id)->price;
    }
}
