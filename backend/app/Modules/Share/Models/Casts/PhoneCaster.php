<?php

namespace App\Modules\Share\Models\Casts;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Share\ValueObjects\Phone;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PhoneCaster implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Phone
    {
        return new Phone($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value instanceof Phone ? $value->value() : $value;
    }
}