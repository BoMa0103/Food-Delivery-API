<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\UpdateOrderRequest;
use App\Services\Orders\Handlers\UpdateOrderHandler;
use Illuminate\Http\JsonResponse;

class UpdateOrderController extends BaseOrderController
{
    private function getUpdateOrderHandler(): UpdateOrderHandler
    {
        return app(UpdateOrderHandler::class);
    }

    public function __invoke(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $order = $this->getOrdersService()->find($id);
        $order = $this->getUpdateOrderHandler()->handle($order, $request->getDTO());

        return response()->json($order);
    }
}
