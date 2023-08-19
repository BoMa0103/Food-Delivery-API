<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Packages\Requests\StorePackageRequest;
use App\Http\Resources\Packages\PackageResource;
use Illuminate\Http\JsonResponse;

class StorePackageController extends BasePackageController
{
    public function __invoke(StorePackageRequest $request): JsonResponse
    {
        $this->authorize('adminRightsCheck', auth()->user());

        $package = $this->getPackagesService()->store($request->getDTO());

        return response()->json(new PackageResource($package));

    }
}
