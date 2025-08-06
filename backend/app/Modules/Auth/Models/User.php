<?php

declare(strict_types=1);

namespace App\Modules\Auth\Models;

use App\Modules\Share\ValueObjects\Phone;
use App\Modules\Share\Models\Casts\PhoneCaster;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $username
 * @property Phone $phone
 */
class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'phone'
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'phone' => PhoneCaster::class
    ];
}