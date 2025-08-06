<?php

namespace App\Modules\Auth\LaravelData;

use InvalidArgumentException;
use Spatie\LaravelData\Casts\Cast;
use App\Modules\Share\ValueObjects\Phone;
use Spatie\LaravelData\Support\DataProperty;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\Support\Creation\CreationContext;

class PhoneCast implements Cast
{
    /**
     * @throws ValidationException
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): Phone
    {
        try {
            return new Phone($value);
        } catch (InvalidArgumentException $e) {
            throw ValidationException::withMessages([
                $property->name => [$e->getMessage()],
            ]);
        }
    }
}
