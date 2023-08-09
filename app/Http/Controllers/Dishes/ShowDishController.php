<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Resources\Dishes\DishResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowDishController extends BaseDishController
{
    public function __invoke(int $id): JsonResponse
    {
        $dish = $this->getDishesService()->find($id);

        if (!$dish) {
            return response()->json([
                'message' => 'Dish not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new DishResource($dish));
    }
}
