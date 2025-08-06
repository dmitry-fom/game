<?php

namespace App\Modules\Game;

use Illuminate\Support\ServiceProvider;
use App\Modules\Game\Contracts\PrizeCalculatorInterface;
use App\Modules\Game\Contracts\GameHistoryRepositoryInterface;
use App\Modules\Game\Repositories\EloquentGameHistoryRepository;
use App\Modules\Game\Services\PrizeCalculator\DefaultPrizeCalculator;

class GameServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PrizeCalculatorInterface::class, DefaultPrizeCalculator::class);
        $this->app->bind(GameHistoryRepositoryInterface::class, EloquentGameHistoryRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
