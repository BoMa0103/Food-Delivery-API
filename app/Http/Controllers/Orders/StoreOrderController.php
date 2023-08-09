<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\StoreOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use Illuminate\Http\JsonResponse;

class StoreOrderController extends BaseOrderController
{
    public function __invoke(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->getOrdersService()->store($request->getDTO());

        return response()->json(new OrderResource($order));
    }
}
