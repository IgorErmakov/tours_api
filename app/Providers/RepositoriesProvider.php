<?php

namespace App\Providers;

use App\Repositories\Contracts\TourRepositoryInterface;
use App\Repositories\Contracts\TravelRepositoryInterface;
use App\Repositories\TourRepository;
use App\Repositories\TravelRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TravelRepositoryInterface::class, TravelRepository::class);
        $this->app->bind(TourRepositoryInterface::class, TourRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
