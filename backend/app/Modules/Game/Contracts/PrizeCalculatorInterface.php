<?php

namespace App\Modules\Game\Contracts;

interface PrizeCalculatorInterface
{
    public function calculate(int $number): int;
}
