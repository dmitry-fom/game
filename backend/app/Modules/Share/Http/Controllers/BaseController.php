<?php

namespace App\Modules\Share\Http\Controllers;

use App\Modules\Auth\Models\User;

class BaseController
{
    public function getUser(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
