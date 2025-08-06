<?php

namespace App\Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class Regenerate extends Data
{
    public function __construct(
        public string $link
    )
    {
    }
}
