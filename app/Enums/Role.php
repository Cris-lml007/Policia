<?php

namespace App\Enums;

enum Role:int
{
    case ADMIN = 0;
    CASE USER = 1;
    case SUPERVISOR = 2;
    case STAFF = 3;
    case DISABLED = 4;
    case SERVICE = 5;
}
