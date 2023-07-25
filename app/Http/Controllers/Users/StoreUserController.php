<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Users\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class StoreUserController extends BaseUserController
{
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        $user = $this->getUsersService()->store($request->getDTO());

        return response()->json($user);
    }
}
