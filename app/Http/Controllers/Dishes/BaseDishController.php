<?php

namespace App\Http\Controllers\Dishes;

use App\Http\Controllers\Controller;
use App\Services\Dishes\DishesService;

abstract class BaseDishController extends Controller
{
    protected function getDishesService(): DishesService
    {
        return app(DishesService::class);
    }
}
