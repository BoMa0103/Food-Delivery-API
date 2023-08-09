<?php

namespace App\Http\Controllers\Categories;

use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoryController extends BaseCategoryController
{
    public function __invoke(int $id): JsonResponse
    {
        $category = $this->getCategoriesService()->find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new CategoryResource($category));
    }
}
