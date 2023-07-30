<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Dishes\Requests\UpdateDishRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UpdateDishController extends BaseDishController
{
    public function __invoke(UpdateDishRequest $request, int $id): JsonResponse
    {
        $dish = $this->getDishesService()->find($id);

        $data = $request->getDTO()->toArray();

        if($data['image'])
        {
            $data['image'] = Storage::putFile('/dishes/images', $data['image']);
        }

        $dish = $this->getDishesService()->update($dish, $request->getDTO()::fromArray($data));

        return response()->json($dish);
    }
}
