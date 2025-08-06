<?php

namespace App\Modules\Game\Services;

use App\Modules\Game\DTO\ImLuckyResult;
use App\Modules\Game\Models\GameHistory;
use App\Modules\Game\Repositories\EloquentGameHistoryRepository;

class GameLogger
{
    public function __construct(
        public EloquentGameHistoryRepository $repository
    )
    {
    }

    public function log(int $userId, ImLuckyResult $result): void
    {
        $gameHistory = new GameHistory();
        $gameHistory->sum = $result->sum;
        $gameHistory->number = $result->number;
        $gameHistory->user_id = $userId;
        $gameHistory->win = $result->win;
        $gameHistory->played_at = new \DateTimeImmutable();

        $this->repository->save($gameHistory);
    }
}