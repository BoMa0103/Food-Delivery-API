<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Companies\Requests\StoreCompanyRequest;
use Illuminate\Http\JsonResponse;

class StoreCompanyController extends BaseCompanyController
{
    public function __invoke(StoreCompanyRequest $request): JsonResponse
    {
        $this->authorize('create', auth()->user());

        $company = $this->getCompaniesService()->store($request->getDTO());

        return response()->json($company);
    }
}
