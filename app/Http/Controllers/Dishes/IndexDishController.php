<?php

namespace App\Http\Controllers\Dishes;

use Illuminate\Http\JsonResponse;

class IndexDishController extends BaseDishController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getDishesService()->index();

        return response()->json($orders);
    }
}
