<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Services\Categories\CategoriesService;

abstract class BaseCategoryController extends Controller
{
    protected function getCategoriesService(): CategoriesService
    {
        return app(CategoriesService::class);
    }
}
