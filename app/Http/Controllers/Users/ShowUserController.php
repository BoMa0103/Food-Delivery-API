<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ShowUserController extends BaseUserController
{
    public function __invoke(int $id): JsonResponse
    {
        $user = $this->getUsersService()->find($id);

        return response()->json($user);
    }
}
