<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\DTO\Regenerate;
use App\Modules\Auth\Models\User as UserModel;
use App\Modules\Auth\Services\MagicLinkGenerator;

class RegenerateMagicLink
{
    public function __construct(
        protected MagicLinkGenerator $magicLinkGenerator
    )
    {
    }

    public function __invoke(UserModel $user): Regenerate
    {
        return new Regenerate(
            link: $this->magicLinkGenerator->generate(
                userId: $user->getKey(),
                regenerate: true
            )
        );
    }
}
