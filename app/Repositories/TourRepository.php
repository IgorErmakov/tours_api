<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TourRepository implements TourRepositoryInterface
{
    public function create(array $data): Tour
    {
        $tour = new Tour;
        $tour->fill($data);
        $tour->save();

        return $tour;
    }

    /**
     * @return Collection<int,Model>
     */
    public function findTours(
        string $travelId,
        int $page,
        int $limit,
        ?CarbonInterface $dateFrom,
        ?CarbonInterface $dateTo,
        int $priceFrom,
        int $priceTo,
        string $sort,
        string $sortDirection
    ): Collection {
        return Tour::query()
            ->where('travelId', $travelId)
            ->forPage($page, $limit)
            ->orderBy('startingDate')
            ->when($sort, fn ($query) => $query->orderBy($sort, $sortDirection))
            ->when($dateFrom, fn ($query) => $query->where('startingDate', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->where('startingDate', '<=', $dateTo))
            ->when($priceFrom, fn ($query) => $query->where('price', '>=', $priceFrom))
            ->when($priceTo, fn ($query) => $query->where('price', '<=', $priceTo))
            ->get()
            ->collect();
    }
}
