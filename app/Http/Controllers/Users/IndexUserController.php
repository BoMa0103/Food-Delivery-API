<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\Users\UserResource;
use Illuminate\Http\JsonResponse;

class IndexUserController extends BaseUserController
{
    public function __invoke(): JsonResponse
    {
        $users = UserResource::collection($this->getUsersService()->index());

        return response()->json($users);
    }
}
