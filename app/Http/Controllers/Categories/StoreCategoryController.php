<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Requests\StoreCategoryRequest;
use Illuminate\Http\JsonResponse;

class StoreCategoryController extends BaseCategoryController
{
    public function __invoke(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->getCategoriesService()->store($request->getDTO());

        return response()->json($category);
    }
}
