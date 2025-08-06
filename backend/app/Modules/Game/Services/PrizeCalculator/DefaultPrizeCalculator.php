<?php

namespace App\Modules\Game\Services\PrizeCalculator;

use App\Modules\Game\Contracts\PrizeCalculatorInterface;

class DefaultPrizeCalculator implements PrizeCalculatorInterface
{
    public function calculate(int $number): int
    {
        if ($number > 900) {
            $amount = (int)($number * 0.7);
        } elseif ($number > 600) {
            $amount = (int)($number * 0.5);
        } elseif ($number > 300) {
            $amount = (int)($number * 0.3);
        } else {
            $amount = (int)($number * 0.1);
        }

        return $amount;
    }
}
