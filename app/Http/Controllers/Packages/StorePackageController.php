<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Packages\Requests\StorePackageRequest;
use Illuminate\Http\JsonResponse;

class StorePackageController extends BasePackageController
{
    public function __invoke(StorePackageRequest $request): JsonResponse
    {
        $this->authorize('create', auth()->user());

        $package = $this->getPackagesService()->store($request->getDTO());

        return response()->json($package);
    }
}
