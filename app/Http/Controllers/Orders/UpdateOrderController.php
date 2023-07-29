<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\UpdateOrderRequest;
use Illuminate\Http\JsonResponse;

class UpdateOrderController extends BaseOrderController
{
    public function __invoke(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $order = $this->getOrdersService()->find($id);
        $order = $this->getOrdersService()->update($order, $request->getDTO());

        return response()->json($order);
    }
}
