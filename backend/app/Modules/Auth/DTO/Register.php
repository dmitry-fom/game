<?php

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class Register extends Data
{
    public function __construct(
        public User   $user,
        public string $link
    )
    {
    }
}
