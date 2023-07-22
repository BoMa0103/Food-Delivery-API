<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\JsonResponse;

class ShowCompanyController extends BaseCompanyController
{
    public function __invoke(int $id): JsonResponse
    {
        $company = $this->getCompaniesService()->find($id);

        return response()->json($company);
    }
}
