<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUserController extends BaseUserController
{
    public function __invoke(): JsonResource
    {
        return UserResource::collection(User::all());
    }
}
