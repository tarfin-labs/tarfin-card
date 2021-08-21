<?php

namespace App\Constants;

class CurrencyType
{
    public const TRY = 'TRY';
    public const EUR = 'EUR';
    public const LEU = 'LEU';
    public const USD = 'USD';

    public const ALL = [
        self::TRY,
        self::EUR,
        self::LEU,
        self::USD,
    ];
}
