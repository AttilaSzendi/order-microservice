<?php

namespace App\Enums;

enum OrderStatus: int
{
    use EnumHelper;

    case NEW = 1;
    case SHIPPED = 2;
}
