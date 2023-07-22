<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Controller;
use App\Services\Packages\PackagesService;

abstract class BasePackageController extends Controller
{
    protected function getPackagesService(): PackagesService
    {
        return app(PackagesService::class);
    }
}
