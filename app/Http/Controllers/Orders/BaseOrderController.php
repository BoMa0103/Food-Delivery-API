<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrdersService;

abstract class BaseOrderController extends Controller
{
    protected function getOrdersService(): OrdersService
    {
        return app(OrdersService::class);
    }
}
