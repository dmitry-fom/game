<?php

namespace App\Modules\Auth\Http\Requests;

use Spatie\LaravelData\Data;
use App\Modules\Share\ValueObjects\Phone;
use Spatie\LaravelData\Attributes\WithCast;
use App\Modules\Auth\LaravelData\PhoneCast;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;

class RegisterUserData extends Data
{
    public function __construct(
        #[Required, StringType, Max(60)]
        public string $username,
        #[Required, WithCast(PhoneCast::class)]
        public Phone  $phone
    )
    {
    }
}
