<?php

namespace App\Modules\Game\Repositories;

use Illuminate\Support\Collection;
use App\Modules\Game\Models\GameHistory;
use App\Modules\Game\Contracts\GameHistoryRepositoryInterface;

class EloquentGameHistoryRepository implements GameHistoryRepositoryInterface
{
    public function save(GameHistory $history): void
    {
        $history->save();
    }

    public function getRecent(int $userId, int $limit = 10): Collection
    {
        return GameHistory::query()
            ->where('user_id', $userId)
            ->orderByDesc('played_at')
            ->limit($limit)
            ->get();
    }
}
