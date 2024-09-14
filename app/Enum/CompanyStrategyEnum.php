<?php

namespace App\Enum;

use App\Services\Auth\Strategy\FooLoginStrategy;
use App\Services\Auth\Strategy\BarLoginStrategy;
use App\Services\Auth\Strategy\BazLoginStrategy;

enum CompanyStrategyEnum: string
{
    use EnumToArray;
    case FOO = FooLoginStrategy::class;
    case BAR = BarLoginStrategy::class;
    case BAZ = BazLoginStrategy::class;
}
