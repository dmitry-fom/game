<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Models\User as UserModel;
use App\Modules\Auth\Services\MagicLinkGenerator;

class DeactivateMagicLink
{
    public function __construct(
        protected MagicLinkGenerator $magicLinkGenerator
    )
    {
    }

    public function __invoke(UserModel $user): void
    {
        $this->magicLinkGenerator->deactivate($user->getKey());
    }
}
