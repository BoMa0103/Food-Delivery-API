<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController extends BaseUserController
{
    public function __invoke(int $id): JsonResponse
    {
        $user = $this->getUsersService()->find($id);

        if(!$user) {
            return response()->json([
                'message' => 'ok',
            ], Response::HTTP_NO_CONTENT);
        }

        $this->authorize('delete', $user);

        $this->getUsersService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
