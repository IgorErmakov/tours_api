<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TravelRepository;
use App\Repositories\Contracts\TravelRepositoryInterface;
use App\Repositories\TourRepository;
use App\Repositories\Contracts\TourRepositoryInterface;

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
