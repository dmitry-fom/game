<?php

namespace App\Modules\Auth\Repositories;

use App\Modules\Auth\Models\AccessToken;
use App\Modules\Auth\Contracts\AccessTokenRepositoryInterface;

class EloquentAccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function save(AccessToken $accessToken): void
    {
        $accessToken->save();
    }

    public function findByUserId(int $userId): ?AccessToken
    {
        return AccessToken::query()
            ->valid()
            ->where(['user_id' => $userId])
            ->first();
    }
}
