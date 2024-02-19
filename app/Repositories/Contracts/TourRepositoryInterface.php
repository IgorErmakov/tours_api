<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Tour;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

interface TourRepositoryInterface
{
    public function create(array $data): Tour;

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
    ): Collection;
}
