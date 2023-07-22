<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteOrderController extends BaseOrderController
{
    public function __invoke(int $id): JsonResponse
    {
        $order = $this->getOrdersService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
