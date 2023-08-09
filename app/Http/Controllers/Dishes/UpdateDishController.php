<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Dishes\Requests\UpdateDishRequest;
use App\Http\Resources\Dishes\DishResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UpdateDishController extends BaseDishController
{
    public function __invoke(UpdateDishRequest $request, int $id): JsonResponse
    {
        $this->authorize('update', auth()->user());

        $dish = $this->getDishesService()->find($id);

        if (!$dish) {
            return response()->json([
                'message' => 'Dish not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $request->getDTO()->toArray();

        if($data['image'])
        {
            $data['image'] = Storage::putFile('/dishes/images', $data['image']);
        }

        $dish = $this->getDishesService()->update($dish, $request->getDTO()::fromArray($data));

        return response()->json(new DishResource($dish));
    }
}
