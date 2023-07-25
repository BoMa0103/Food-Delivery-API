<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(100000, 999999),
            'cart_items' => [
                [
                    'id' => $this->faker->numberBetween(1, 10),
                    'count' => $this->faker->numberBetween(1, 10),
                ],
                [
                    'id' => $this->faker->numberBetween(1, 10),
                    'count' => $this->faker->numberBetween(1, 10),
                ]
            ],
            'deliveryType' => $this->faker->numberBetween(1,2),
            'deliveryTime' => 0,
        ];
    }
}
