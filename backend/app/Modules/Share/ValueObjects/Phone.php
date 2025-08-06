<?php

namespace App\Modules\Share\ValueObjects;

use InvalidArgumentException;

readonly class Phone
{
    const PHONE_PATTERN = '/^\+?[0-9]{11,13}$/';

    public function __construct(
        private string $value
    )
    {
        if (!preg_match(self::PHONE_PATTERN, $this->value)) {
            throw new InvalidArgumentException('Invalid phone number');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
