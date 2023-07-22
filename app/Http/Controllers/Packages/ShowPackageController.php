<?php

namespace App\Http\Controllers\Packages;

use Illuminate\Http\JsonResponse;

class ShowPackageController extends BasePackageController
{
    public function __invoke(int $id): JsonResponse
    {
        $package = $this->getPackagesService()->find($id);

        return response()->json($package);
    }
}
