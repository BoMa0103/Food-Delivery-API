<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCompanyController extends BaseCompanyController
{
    public function __invoke(int $id): JsonResponse
    {
        $this->authorize('adminRightsCheck', auth()->user());

        $this->getCompaniesService()->delete($id);

        return response()->json([
            'message' => 'ok',
        ], Response::HTTP_NO_CONTENT);
    }
}
