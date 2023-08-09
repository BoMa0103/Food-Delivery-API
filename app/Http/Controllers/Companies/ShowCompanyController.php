<?php

namespace App\Http\Controllers\Companies;

use App\Http\Resources\Companies\CompanyResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowCompanyController extends BaseCompanyController
{
    public function __invoke(int $id): JsonResponse
    {
        $company = $this->getCompaniesService()->find($id);

        if (!$company) {
            return response()->json([
                'message' => 'Company not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new CompanyResource($company));
    }
}
