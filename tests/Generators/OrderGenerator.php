<?php

namespace Tests\Generators;

use App\Models\Company;
use App\Models\Order;

class OrderGenerator
{
    public static function generate(array $data = []): Order
    {
        $company = Company::factory()->create();
        return Order::factory()->for($company)->create($data);
    }
}
