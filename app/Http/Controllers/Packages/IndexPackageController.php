<?php

namespace App\Http\Controllers\Packages;

use Illuminate\Http\JsonResponse;

class IndexPackageController extends BasePackageController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getPackagesService()->index();

        return response()->json($orders);
    }
}
