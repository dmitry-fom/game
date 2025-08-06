<?php

namespace App\Modules\Game\Contracts;

use App\Modules\Game\Models\GameHistory;

interface GameHistoryRepositoryInterface
{
    public function save(GameHistory $history);

    public function getRecent(int $userId, int $limit);
}
