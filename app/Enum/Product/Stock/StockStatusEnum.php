<?php

namespace App\Enum\Product\Stock;

enum StockStatusEnum: int
{
    case ADD = 1;
    case SUBTRACT = 0;
}
