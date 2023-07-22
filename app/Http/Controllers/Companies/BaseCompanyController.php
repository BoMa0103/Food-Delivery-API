<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Services\Companies\CompaniesService;

abstract class BaseCompanyController extends Controller
{
    protected function getCompaniesService(): CompaniesService
    {
        return app(CompaniesService::class);
    }
}
