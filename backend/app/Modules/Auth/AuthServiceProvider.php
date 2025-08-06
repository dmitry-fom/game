<?php

namespace App\Modules\Auth;

use Illuminate\Support\ServiceProvider;
use App\Modules\Auth\Contracts\TokenizerInterface;
use App\Modules\Auth\Contracts\UrlBuilderInterface;
use App\Modules\Auth\Services\SecretPageAUrlBuilder;
use App\Modules\Auth\Services\Tokenizer\UuidTokenizer;
use App\Modules\Auth\Contracts\UserRepositoryInterface;
use App\Modules\Auth\Repositories\EloquentUserRepository;
use App\Modules\Auth\Contracts\AccessTokenRepositoryInterface;
use App\Modules\Auth\Repositories\EloquentAccessTokenRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TokenizerInterface::class, UuidTokenizer::class);
        $this->app->bind(UrlBuilderInterface::class, function () {
            return new SecretPageAUrlBuilder(config('app.frontend_url'));
        });
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AccessTokenRepositoryInterface::class, EloquentAccessTokenRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
