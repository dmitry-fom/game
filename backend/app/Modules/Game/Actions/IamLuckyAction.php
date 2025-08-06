<?php

namespace App\Modules\Game\Actions;

use App\Modules\Game\DTO\ImLuckyResult;
use App\Modules\Game\Services\IAmLuckyGame;
use App\Modules\Game\Services\GameLogger;
use App\Modules\Auth\Models\User as UserModel;

class IamLuckyAction
{
    public function __construct(
        protected IAmLuckyGame $iamLuckyGame,
        protected GameLogger   $gameLogger,
    )
    {
    }

    public function __invoke(UserModel $user): ImLuckyResult
    {
        $result = $this->iamLuckyGame->play();

        $this->gameLogger->log($user->getKey(), $result);

        return $result;
    }
}
