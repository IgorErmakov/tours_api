<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\TourRepositoryInterface;
use App\Repositories\Contracts\TravelRepositoryInterface;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class TourRetrieval
{
    public function __construct(
        protected TravelRepositoryInterface $travelRepository,
        protected TourRepositoryInterface $tourRepository
    ) {
    }

    public function findTours(
        string $slug,
        int $page,
        ?CarbonInterface $dateFrom,
        ?CarbonInterface $dateTo,
        int $priceFrom,
        int $priceTo,
        string $sort,
        string $sortDirection
    ): Collection {
        $travel = $this->travelRepository->findPublicTravelBySlug($slug);
        if (! $travel) {

            return collect();
        }

        $limit = (int) config('app.tours.pagination_limit', 10);

        return $this->tourRepository->findTours(
            $travel->id,
            $page,
            $limit,
            $dateFrom,
            $dateTo,
            $priceFrom,
            $priceTo,
            $sort,
            $sortDirection
        );
    }
}
