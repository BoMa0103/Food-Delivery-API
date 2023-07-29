<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\JsonResponse;

class IndexUserController extends BaseUserController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getUsersService()->index();

        return response()->json($orders);
    }
}
