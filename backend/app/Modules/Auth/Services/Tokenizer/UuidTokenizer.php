<?php

namespace App\Modules\Auth\Services\Tokenizer;

use Illuminate\Support\Str;
use App\Modules\Auth\Contracts\TokenizerInterface;

class UuidTokenizer implements TokenizerInterface
{
    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
