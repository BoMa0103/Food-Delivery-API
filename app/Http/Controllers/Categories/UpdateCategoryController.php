<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Requests\UpdateCategoryRequest;
use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryController extends BaseCategoryController
{
    public function __invoke(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $this->authorize('update', auth()->user());

        $category = $this->getCategoriesService()->find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $company = $this->getCategoriesService()->update($category, $request->getDTO());

        return response()->json(new CategoryResource($category));
    }
}
