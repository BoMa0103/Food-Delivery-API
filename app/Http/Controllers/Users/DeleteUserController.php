<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController extends BaseUserController
{
    public function __invoke(int $id): JsonResponse
    {
        $this->authorize('delete', auth()->user());

        $this->getUsersService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
