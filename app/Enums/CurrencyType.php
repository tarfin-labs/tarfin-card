<?php

declare(strict_types=1);

namespace App\Enums;

enum CurrencyType: string
{
    case TRY = 'TRY';
    case EUR = 'EUR';
    case LEU = 'LEU';
    case USD = 'USD';
}
