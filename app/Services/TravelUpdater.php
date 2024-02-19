<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Travel;
use App\Repositories\Contracts\TravelRepositoryInterface;

class TravelUpdater
{
    public function __construct(protected TravelRepositoryInterface $repository)
    {
    }

    public function update(string $travelId, array $data): Travel
    {
        return $this->repository->update($travelId, $data);
    }
}
