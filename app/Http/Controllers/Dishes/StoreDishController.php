<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Dishes\Requests\StoreDishRequest;
use Illuminate\Http\JsonResponse;

class StoreDishController extends BaseDishController
{
    public function __invoke(StoreDishRequest $request): JsonResponse
    {
        $dish = $this->getDishesService()->store($request->getDTO());

        return response()->json($dish);
    }
}
