<?php

namespace App\Http\Controllers\Orders;

use App\Http\Resources\Orders\OrderResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowOrderController extends BaseOrderController
{
    public function __invoke(int $id): JsonResponse
    {
        $order = $this->getOrdersService()->find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new OrderResource($order));
    }
}
