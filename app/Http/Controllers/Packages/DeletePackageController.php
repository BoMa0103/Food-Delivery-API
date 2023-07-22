<?php

namespace App\Http\Controllers\Packages;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePackageController extends BasePackageController
{
    public function __invoke(int $id): JsonResponse
    {
        $package = $this->getPackagesService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
