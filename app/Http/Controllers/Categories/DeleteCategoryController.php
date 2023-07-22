<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCategoryController extends BaseCategoryController
{
    public function __invoke(int $id): JsonResponse
    {
        $category = $this->getCategoriesService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
