<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\StoreOrderRequest;
use App\Services\Orders\Handlers\CreateOrderHandler;
use Illuminate\Http\JsonResponse;

class StoreOrderController extends BaseOrderController
{
    private function getCreateOrderHandler(): CreateOrderHandler
    {
        return app(CreateOrderHandler::class);
    }

    public function __invoke(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->getCreateOrderHandler()->handle($request->getDTO());

        return response()->json($order);
    }
}
