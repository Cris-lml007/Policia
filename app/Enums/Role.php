<?php

namespace App\Enums;

enum Role:int
{
    case ADMIN = 0;
    CASE USER = 1;
    case SUPERVISOR = 2;
    case STAFF = 3;
}
