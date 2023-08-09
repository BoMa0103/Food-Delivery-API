<?php

namespace App\Http\Controllers\Categories;

use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\JsonResponse;

class IndexCategoryController extends BaseCategoryController
{
    public function __invoke(): JsonResponse
    {
        $categories = CategoryResource::collection($this->getCategoriesService()->index());

        return response()->json($categories);
    }
}
