<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Dishes\Requests\UpdateDishRequest;
use Illuminate\Http\JsonResponse;

class UpdateDishController extends BaseDishController
{
    public function __invoke(UpdateDishRequest $request, int $id): JsonResponse
    {
        $dish = $this->getDishesService()->find($id);
        $dish = $this->getDishesService()->update($dish, $request->getDTO());

        return response()->json($dish);
    }
}
