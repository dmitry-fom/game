<?php

namespace App\Modules\Auth\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property bool $is_active
 * @property DateTimeImmutable $expires_at
 * @property string $token
 * @property User $user
 */
class AccessToken extends Model
{
    protected $table = 'access_tokens';

    protected $fillable = [
        'user_id',
        'token',
        'is_active',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'immutable_datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeValid($query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where('expires_at', '>=', new DateTimeImmutable());
    }
}
