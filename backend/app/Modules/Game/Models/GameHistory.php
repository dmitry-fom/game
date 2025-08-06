<?php

namespace App\Modules\Game\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $number
 * @property bool $win
 * @property int $sum
 * @property DateTimeImmutable $played_at
 */
class GameHistory extends Model
{
    public $table = 'game_history';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'number',
        'win',
        'sum',
        'played_at'
    ];

    protected $casts = [
        'played_at' => 'immutable_datetime',
    ];
}
