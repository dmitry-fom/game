<?php

namespace App\Modules\Game\Actions;

use Illuminate\Support\Collection;
use App\Modules\Auth\Models\User as UserModel;
use App\Modules\Game\Repositories\EloquentGameHistoryRepository;

class GetHistoryAction
{
    protected const LIMIT = 3;

    public function __construct(
        public EloquentGameHistoryRepository $repository
    )
    {
    }

    public function __invoke(UserModel $user): Collection
    {
        return $this->repository->getRecent($user->getKey(), self::LIMIT);
    }
}
