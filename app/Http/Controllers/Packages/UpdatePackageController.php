<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Packages\Requests\UpdatePackageRequest;
use App\Http\Resources\Packages\PackageResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdatePackageController extends BasePackageController
{
    public function __invoke(UpdatePackageRequest $request, int $id): JsonResponse
    {
        $this->authorize('update', auth()->user());

        $package = $this->getPackagesService()->find($id);

        if (!$package) {
            return response()->json([
                'message' => 'Package not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $package = $this->getPackagesService()->update($package, $request->getDTO());

        return response()->json(new PackageResource($package));

    }
}
