<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Auth\Http\Requests\RegisterUserData;
use App\Modules\Auth\Contracts\UserRepositoryInterface;

class RegisterUserService
{
    public function __construct(
        protected UserRepositoryInterface $users
    )
    {
    }

    public function register(RegisterUserData $dto): User
    {
        if (!$user = $this->users->findByPhone($dto->phone)) {
            $user = new User();
            $user->phone = $dto->phone;
        }
        $user->username = $dto->username;

        $this->users->save($user);

        return $user;
    }
}