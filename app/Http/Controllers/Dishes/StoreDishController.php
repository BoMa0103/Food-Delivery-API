<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Dishes\Requests\StoreDishRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class StoreDishController extends BaseDishController
{
    public function __invoke(StoreDishRequest $request): JsonResponse
    {
        $data = $request->getDTO()->toArray();

        if($data['image'])
        {
            $data['image'] = Storage::putFile('/dishes/images', $data['image']);
        }

        $dish = $this->getDishesService()->store(
            $request->getDTO()::fromArray($data)
        );

        return response()->json($dish);
    }
}
