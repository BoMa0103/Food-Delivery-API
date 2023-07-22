<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;

class UpdateCategoryController extends BaseCategoryController
{
    public function __invoke(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = $this->getCategoriesService()->find($id);
        $category = $this->getCategoriesService()->update($category, $request->getDTO());

        return response()->json($category);
    }
}
