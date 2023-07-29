<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;

class StoreOrderController extends BaseOrderController
{
    public function __invoke(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->getOrdersService()->store($request->getDTO());

        return response()->json($order);
    }
}
