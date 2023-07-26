<?php

namespace App\Services\Companies\DTO;

enum CompanyDTO: int
{
    case STATUS_IS_WORKING = 1;
    case STATUS_IS_NOT_WORKING = 0;

    case DEFAULT_RATING = 3;
}
