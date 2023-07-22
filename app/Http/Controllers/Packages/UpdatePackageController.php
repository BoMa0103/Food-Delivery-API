<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Packages\Requests\UpdatePackageRequest;
use Illuminate\Http\JsonResponse;

class UpdatePackageController extends BasePackageController
{
    public function __invoke(UpdatePackageRequest $request, int $id): JsonResponse
    {
        $package = $this->getPackagesService()->find($id);
        $package = $this->getPackagesService()->update($package, $request->getDTO());

        return response()->json($package);
    }
}
