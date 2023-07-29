<?php

namespace App\Http\Controllers\Users;

use App\Events\UserCreated;
use App\Http\Controllers\Users\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class StoreUserController extends BaseUserController
{
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        $user = $this->getUsersService()->store($request->getDTO());

        UserCreated::dispatch($user);

        return response()->json($user);
    }
}
