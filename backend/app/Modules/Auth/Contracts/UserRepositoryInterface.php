<?php

namespace App\Modules\Auth\Contracts;

use App\Modules\Auth\Models\User;
use App\Modules\Share\ValueObjects\Phone;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findByPhone(Phone $phone);
}