<?php

namespace App\Modules\Auth\Contracts;

interface TokenizerInterface
{
    public function generate(): string;
}
