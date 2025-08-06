<?php

namespace App\Modules\Auth\Contracts;

use App\Modules\Auth\Models\AccessToken;

interface AccessTokenRepositoryInterface
{
    public function findByUserId(int $userId);

    public function save(AccessToken $accessToken);
}
