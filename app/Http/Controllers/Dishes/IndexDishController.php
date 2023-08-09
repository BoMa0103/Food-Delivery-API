<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Resources\Dishes\DishResource;
use Illuminate\Http\JsonResponse;

class IndexDishController extends BaseDishController
{
    public function __invoke(): JsonResponse
    {
        $dishes = DishResource::collection($this->getDishesService()->index());

        return response()->json($dishes);
    }
}
