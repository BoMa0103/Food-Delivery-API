<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\JsonResponse;

class ShowOrderController extends BaseOrderController
{
    public function __invoke(int $id): JsonResponse
    {
        $order = $this->getOrdersService()->find($id);

        return response()->json($order);
    }
}
