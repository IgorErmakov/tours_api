<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Travel;
use App\Repositories\Contracts\TravelRepositoryInterface;

class TravelRepository implements TravelRepositoryInterface
{
    public function findPublicTravelBySlug(string $slug): ?Travel
    {
        return Travel::query()
            ->where('slug', $slug)
            ->where('public', true)
            ->limit(1)
            ->first();
    }

    public function create(array $data): Travel
    {
        $travel = new Travel;
        $travel->fill($data);
        $travel->save();

        return $travel;
    }

    public function update(string $travelId, array $data): Travel
    {
        /** @var Travel $travel */
        $travel = Travel::findOrFail($travelId);
        $travel->update($data);

        return $travel;
    }
}
