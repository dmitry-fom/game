<?php

namespace App\Modules\Auth\Repositories;

use App\Modules\Auth\Models\User;
use App\Modules\Share\ValueObjects\Phone;
use App\Modules\Auth\Contracts\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByPhone(Phone $phone): ?User
    {
        return User::query()
            ->where('phone', $phone->value())
            ->first();
    }

    public function save(User $user): void
    {
        $user->save();
    }
}
