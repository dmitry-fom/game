<?php

declare(strict_types=1);

namespace App\Modules\Auth\Rules;

use Attribute;
use Spatie\LaravelData\Attributes\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Phone extends Rule
{
    public function __construct()
    {
        parent::__construct('regex:/^\+?[1-9]\d{7,14}$/');
    }
}
