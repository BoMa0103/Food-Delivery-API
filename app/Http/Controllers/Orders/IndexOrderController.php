<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\JsonResponse;

class IndexOrderController extends BaseOrderController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getOrdersService()->index();

        return response()->json($orders);
    }
}
