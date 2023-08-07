<?php

namespace App\Http\Controllers\Dishes;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteDishController extends BaseDishController
{
    public function __invoke(int $id): JsonResponse
    {
        $this->authorize('delete', auth()->user());

        $this->getDishesService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
