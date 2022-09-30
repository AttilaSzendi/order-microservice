<?php

namespace App\Enums;

enum AddressType: int
{
    use EnumHelper;

    case BILLING = 1;
    case SHIPPING = 2;
}
