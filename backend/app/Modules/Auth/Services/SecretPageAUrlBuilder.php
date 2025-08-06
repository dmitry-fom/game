<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Contracts\UrlBuilderInterface;

readonly class SecretPageAUrlBuilder implements UrlBuilderInterface
{
    public function __construct(
        private string $baseUrl
    )
    {
    }

    public function build(string $token): string
    {
        return sprintf('%s/page-a?token=%s', rtrim($this->baseUrl, '/'), $token);
    }
}
