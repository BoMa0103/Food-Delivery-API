<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\Users\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowUserController extends BaseUserController
{
    public function __invoke(int $id): JsonResponse
    {
        $user = $this->getUsersService()->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new UserResource($user));
    }
}
