<?php

namespace App\Enum\Company;

enum CompanyIsActiveEnum: int
{
    case ACTIVE = 1;
    case PASSIVE = 0;
}
