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
}
