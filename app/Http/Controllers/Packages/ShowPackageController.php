<?php

namespace App\Http\Controllers\Packages;

use App\Http\Resources\Packages\PackageResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowPackageController extends BasePackageController
{
    public function __invoke(int $id): JsonResponse
    {
        $package = $this->getPackagesService()->find($id);

        if (!$package) {
            return response()->json([
                'message' => 'Package not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new PackageResource($package));
    }
}
