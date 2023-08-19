<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Companies\Requests\UpdateCompanyRequest;
use App\Http\Resources\Companies\CompanyResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateCompanyController extends BaseCompanyController
{
    public function __invoke(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        $this->authorize('adminRightsCheck', auth()->user());

        $company = $this->getCompaniesService()->find($id);

        if (!$company) {
            return response()->json([
                'message' => 'Order not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $company = $this->getCompaniesService()->update($company, $request->getDTO());

        return response()->json(new CompanyResource($company));
    }
}
