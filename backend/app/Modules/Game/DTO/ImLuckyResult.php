<?php

namespace App\Modules\Game\DTO;

class ImLuckyResult
{
    public function __construct(
        public int  $number,
        public bool $win,
        public int  $sum
    )
    {
    }
}
