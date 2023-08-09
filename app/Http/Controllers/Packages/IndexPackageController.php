<?php

namespace App\Http\Controllers\Packages;

use App\Http\Resources\Packages\PackageResource;
use Illuminate\Http\JsonResponse;

class IndexPackageController extends BasePackageController
{
    public function __invoke(): JsonResponse
    {
        $packages = PackageResource::collection($this->getPackagesService()->index());

        return response()->json($packages);
    }
}
