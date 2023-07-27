<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;

class OrderGenerator
{
    public static function generate(array $data = []): Order
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $package = Package::factory()->for($company)->create();
        $company->setAttribute('base_package_id', $package->id);
        $company->save();
        return Order::factory()->for($company)->for($user)->create($data);
    }

    public static function storeOrderDTOArrayGenerate(array $data = []): array
    {
        return [
            'number' => $data['number'] ?? fake()->numberBetween(100000, 999999),
            'cart_items' => $data['cart_items'] ?? json_encode([
                    [
                        'id' => fake()->numberBetween(1, 20),
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
            'company_id' => $data['company_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'deliveryType' => fake()->numberBetween(1, 2),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => $data['deliveryAddressStreet'] ?? fake()->streetAddress,
            'deliveryAddressHouse' => $data['deliveryAddressStreet'] ?? fake()->address,
            'prices' => $data['prices'] ?? json_encode([
                    'itemsPrice' => fake()->numberBetween(1, 1000),
                    'packagePrice' => fake()->numberBetween(1, 100),
                    'deliveryPrice' => fake()->numberBetween(1, 100),
                    'fullPrice' => fake()->numberBetween(1, 1000),
                ]),
            'user' => $data['user'] ?? json_encode([
                    'id' => fake()->numberBetween(1, 20),
                    'name' => fake()->name,
                    'email' => fake()->email,
                ]),
            'package' => $data['package'] ?? json_encode([
                    'name' => fake()->name,
                    'price' => fake()->randomFloat(1, 100),
                ]),
        ];
    }

    public static function updateOrderDTOArrayGenerate(array $data = []): array
    {
        return [
            'number' => $data['number'] ?? fake()->numberBetween(100000, 999999),
            'cart_items' => $data['cart_items'] ?? json_encode([
                    [
                        'id' => fake()->numberBetween(1, 20),
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
            'company_id' => $data['company_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'deliveryType' => fake()->numberBetween(1, 2),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => $data['deliveryAddressStreet'] ?? fake()->streetAddress,
            'deliveryAddressHouse' => $data['deliveryAddressStreet'] ?? fake()->address,
            'prices' => $data['prices'] ?? json_encode([
                    'itemsPrice' => fake()->numberBetween(1, 1000),
                    'packagePrice' => fake()->numberBetween(1, 100),
                    'deliveryPrice' => fake()->numberBetween(1, 100),
                    'fullPrice' => fake()->numberBetween(1, 1000),
                ]),
            'user' => $data['user'] ?? json_encode([
                    'id' => fake()->numberBetween(1, 20),
                    'name' => fake()->name,
                    'email' => fake()->email,
                ]),
            'package' => $data['package'] ?? json_encode([
                    'name' => fake()->name,
                    'price' => fake()->randomFloat(1, 100),
                ]),
        ];
    }

    public static function storeOrderRequestDTOArrayGenerate(array $data = []): array
    {
        return [
            'cart_items' => $data['cart_items'] ?? json_encode([
                    [
                        'id' => fake()->numberBetween(1, 20),
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
            'company_id' => $data['company_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'deliveryType' => fake()->numberBetween(1, 2),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => $data['deliveryAddressStreet'] ?? fake()->streetAddress,
            'deliveryAddressHouse' => $data['deliveryAddressStreet'] ?? fake()->address,
        ];
    }

    public static function updateOrderRequestDTOArrayGenerate(array $data = []): array
    {
        return [
            'cart_items' => $data['cart_items'] ?? json_encode([
                    [
                        'id' => fake()->numberBetween(1, 20),
                        'count' => fake()->numberBetween(1, 20),
                    ],
                ]),
            'company_id' => $data['company_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'deliveryType' => fake()->numberBetween(1, 2),
            'deliveryTime' => 0,
            'deliveryAddressStreet' => $data['deliveryAddressStreet'] ?? fake()->streetAddress,
            'deliveryAddressHouse' => $data['deliveryAddressStreet'] ?? fake()->address,
        ];
    }
}
