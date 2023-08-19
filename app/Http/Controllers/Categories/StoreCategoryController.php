<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Requests\StoreCategoryRequest;
use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\JsonResponse;

class StoreCategoryController extends BaseCategoryController
{
    public function __invoke(StoreCategoryRequest $request): JsonResponse
    {
        $this->authorize('adminRightsCheck', auth()->user());

        $category = $this->getCategoriesService()->store($request->getDTO());

        return response()->json(new CategoryResource($category));
    }
}
