<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\DTO\User;
use App\Modules\Auth\DTO\Register;
use App\Modules\Auth\Services\MagicLinkGenerator;
use App\Modules\Auth\Services\RegisterUserService;
use App\Modules\Auth\Http\Requests\RegisterUserData;

class RegisterUserAction
{
    public function __construct(
        protected RegisterUserService $registrationService,
        protected MagicLinkGenerator  $magicLinkGenerator,
    )
    {
    }

    public function __invoke(RegisterUserData $dto): Register
    {
        $user = $this->registrationService->register($dto);

        return new Register(
            user: new User(
                $user->id,
                $user->username,
                $user->phone->value()
            ),
            link: $this->magicLinkGenerator->generate($user->getKey()),
        );
    }
}