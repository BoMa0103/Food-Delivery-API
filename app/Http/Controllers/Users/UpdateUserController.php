<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Users\Requests\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController extends BaseUserController
{
    public function __invoke(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->getUsersService()->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user = $this->getUsersService()->update($user, $request->getDTO());

        return response()->json(new UserResource($user));
    }
}
