<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Order;
use App\Models\User;

class OrderGenerator
{
    public static function generate(array $data = []): Order
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        return Order::factory()->for($company)->for($user)->create($data);
    }

    public static function storeOrderDTOArrayGenerate(array $data = []): array
    {
        return [
            'number' => $data['number'] ?? fake()->numberBetween(10000, 99999),
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

    public static function updateOrderDTOArrayGenerate(array $data = []): array
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
