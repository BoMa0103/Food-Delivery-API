<?php

namespace App\Services\Orders\DTO;

enum OrderDTO: int
{
    case DELIVERY_TIME_AS_SOON_AS_POSSIBLE = 0;

    case DELIVERY_TYPE_TO_DOOR = 1;
    case DELIVERY_TYPE_PICKUP = 2;
}
