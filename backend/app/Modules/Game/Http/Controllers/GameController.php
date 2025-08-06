<?php

namespace App\Modules\Game\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Modules\Game\Actions\IamLuckyAction;
use App\Modules\Game\Actions\GetHistoryAction;
use App\Modules\Game\Resources\HistoryResource;
use App\Modules\Share\Http\Controllers\BaseController;

class GameController extends BaseController
{
    public function play(
        IamLuckyAction $iamLuckyAction
    ): JsonResponse
    {
        $iamLuckyResultDTO = $iamLuckyAction($this->getUser());

        return response()->json($iamLuckyResultDTO);
    }

    public function history(
        GetHistoryAction $getHistoryAction
    ): JsonResponse
    {
        $collection = $getHistoryAction($this->getUser());

        return response()->json(
            HistoryResource::collection($collection)
        );
    }
}
