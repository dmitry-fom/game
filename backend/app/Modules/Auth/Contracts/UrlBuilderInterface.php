<?php

namespace App\Modules\Auth\Contracts;

interface UrlBuilderInterface
{
    public function build(string $token): string;
}
