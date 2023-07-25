<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\UsersService;

abstract class BaseUserController extends Controller
{
    protected function getUsersService(): UsersService
    {
        return app(UsersService::class);
    }
}
