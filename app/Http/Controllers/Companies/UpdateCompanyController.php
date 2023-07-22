<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Companies\Requests\UpdateCompanyRequest;
use Illuminate\Http\JsonResponse;

class UpdateCompanyController extends BaseCompanyController
{
    public function __invoke(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        $company = $this->getCompaniesService()->find($id);
        $company = $this->getCompaniesService()->update($company, $request->getDTO());

        return response()->json($company);
    }
}
