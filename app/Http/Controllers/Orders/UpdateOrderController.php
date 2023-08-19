<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Orders\Requests\UpdateOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderController extends BaseOrderController
{
    public function __invoke(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $this->authorize('adminRightsCheck', auth()->user());

        $order = $this->getOrdersService()->find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $order = $this->getOrdersService()->update($order, $request->getDTO());

        return response()->json(new OrderResource($order));
    }
}
