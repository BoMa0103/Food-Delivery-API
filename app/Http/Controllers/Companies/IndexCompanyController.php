<?php

namespace App\Http\Controllers\Companies;

use App\Http\Resources\Companies\CompanyResource;
use Illuminate\Http\JsonResponse;

class IndexCompanyController extends BaseCompanyController
{
    public function __invoke(): JsonResponse
    {
        $companies = CompanyResource::collection($this->getCompaniesService()->index());

        return response()->json($companies);
    }
}
