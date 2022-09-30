<?php

namespace App\Enums;

enum DeliveryMethod: int
{
    use EnumHelper;

    case PICK_UP_IN_STORE = 1;
    case HOME_DELIVERY = 2;
}
