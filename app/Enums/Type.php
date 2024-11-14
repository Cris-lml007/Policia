<?php

namespace App\Enums;

enum Type:int
{
    case MANUAL = 1;
    case QR = 2;
    case POSITIONING = 3;
}
