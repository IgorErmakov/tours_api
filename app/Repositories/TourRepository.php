<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;

class TourRepository implements TourRepositoryInterface
{
    public function create(array $data): Tour
    {
        $travel = new Tour;
        $travel->fill($data);
        $travel->save();

        return $travel;
    }

    public function update(string $tourId, array $data): Tour
    {
        /** @var Tour $tour */
        $tour = Tour::findOrFail($tourId);
        $tour->update($data);

        return $tour;
    }
}
