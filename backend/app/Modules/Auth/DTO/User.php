<?php

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class User extends Data
{
    public function __construct(
        public int    $id,
        public string $username,
        public string $phone,
    )
    {
    }
}
