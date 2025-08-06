<?php

namespace App\Modules\Auth\Services;

use DateTimeImmutable;
use App\Modules\Auth\Models\AccessToken;
use App\Modules\Auth\Contracts\TokenizerInterface;
use App\Modules\Auth\Contracts\UrlBuilderInterface;
use App\Modules\Auth\Contracts\AccessTokenRepositoryInterface;

class MagicLinkGenerator
{
    private const DEFAULT_TTL = 7 * 24 * 60; // 7 days

    public function __construct(
        private readonly AccessTokenRepositoryInterface $accessTokens,
        private readonly TokenizerInterface             $tokenizer,
        private readonly UrlBuilderInterface            $urlBuilder
    )
    {
    }

    public function generate(
        int  $userId,
        int  $ttlMinutes = self::DEFAULT_TTL,
        bool $regenerate = false
    ): string
    {
        if ($regenerate || !$accessToken = $this->accessTokens->findByUserId($userId)) {
            $accessToken = new AccessToken();
            $accessToken->user_id = $userId;
            $accessToken->token = $this->tokenizer->generate();
            $accessToken->expires_at = new DateTimeImmutable("+$ttlMinutes minutes");
            $accessToken->is_active = true;

            $this->accessTokens->save($accessToken);
        }

        if ($regenerate) {
            $this->deactivate($userId);
        }

        return $this->urlBuilder->build($accessToken->token);
    }

    public function deactivate(int $userId): void
    {
        $accessToken = $this->accessTokens->findByUserId($userId);
        $accessToken->is_active = false;

        $this->accessTokens->save($accessToken);
    }
}
