<?php

namespace App\Modules\Game\Services;

use Throwable;
use Psr\Log\LoggerInterface;
use App\Modules\Game\DTO\ImLuckyResult;
use App\Modules\Game\Contracts\PrizeCalculatorInterface;

class IAmLuckyGame
{
    private const NUMBER_FROM = 1;
    private const NUMBER_TO = 1000;

    public function __construct(
        protected PrizeCalculatorInterface $prizeCalculator,
        protected LoggerInterface          $logger
    )
    {
    }

    public function play(): ImLuckyResult
    {
        try {
            $number = random_int(self::NUMBER_FROM, self::NUMBER_TO);
        } catch (Throwable $e) {
            $this->logger->error('Random number generation failed: ' . $e->getMessage());

            return new ImLuckyResult(
                number: 0,
                win: false,
                sum: 0
            );
        }

        $win = $number % 2 === 0;

        if ($win) {
            $sum = $this->prizeCalculator->calculate($number);
        }

        return new ImLuckyResult(
            number: $number,
            win: $win,
            sum: $sum ?? 0
        );
    }
}
