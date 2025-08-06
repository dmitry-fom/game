<?php

namespace App\Modules\Game\Resources;

use Illuminate\Http\Request;
use App\Modules\Game\Models\GameHistory;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var GameHistory $gameHistory */
        $gameHistory = $this->resource;

        return [
            'sum' => $gameHistory->sum,
            'number' => $gameHistory->number,
            'played_at' => $gameHistory->played_at,
            'win' => $gameHistory->win,
        ];
    }
}
