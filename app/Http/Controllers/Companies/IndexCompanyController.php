<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\JsonResponse;

class IndexCompanyController extends BaseCompanyController
{
    public function __invoke(): JsonResponse
    {
        $orders = $this->getCompaniesService()->index();

        return response()->json($orders);
    }
}
