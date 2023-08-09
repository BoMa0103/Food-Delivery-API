<?php

namespace App\Http\Controllers\Orders;

use App\Http\Resources\Orders\OrderResource;
use Illuminate\Http\JsonResponse;

class IndexOrderController extends BaseOrderController
{
    public function __invoke(): JsonResponse
    {
        $orders = OrderResource::collection($this->getOrdersService()->index());

        return response()->json($orders);
    }
}
