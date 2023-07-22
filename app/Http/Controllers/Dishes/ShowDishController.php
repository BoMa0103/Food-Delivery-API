<?php

namespace App\Http\Controllers\Dishes;

use Illuminate\Http\JsonResponse;

class ShowDishController extends BaseDishController
{
    public function __invoke(int $id): JsonResponse
    {
        $dish = $this->getDishesService()->find($id);

        return response()->json($dish);
    }
}
