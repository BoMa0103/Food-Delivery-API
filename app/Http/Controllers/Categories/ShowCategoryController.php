<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\JsonResponse;

class ShowCategoryController extends BaseCategoryController
{
    public function __invoke(int $id): JsonResponse
    {
        $category = $this->getCategoriesService()->find($id);

        return response()->json($category);
    }
}
