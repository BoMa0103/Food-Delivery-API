<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\JsonResponse;

class IndexCategoryController extends BaseCategoryController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getCategoriesService()->index();

        return response()->json($orders);
    }
}
