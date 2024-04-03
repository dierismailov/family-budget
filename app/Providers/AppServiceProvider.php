<?php

namespace App\Providers;

use App\Contracts\IBudgetRepository;
use App\Contracts\IStatisticRepository;
use App\Contracts\ITransactionRepository;
use App\Contracts\IUserRepository;
use App\Repositories\BudgetRepository;
use App\Repositories\StatisticRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IBudgetRepository::class, BudgetRepository::class);
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
        $this->app->bind(IStatisticRepository::class, StatisticRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
