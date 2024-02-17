<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;

class TourUpdater
{
    public function __construct(protected TourRepositoryInterface $repository)
    {
    }

    public function update(string $tourId, array $data): Tour
    {
        // @todo igor: adds logs, creates events, etc..
        return $this->repository->update($tourId, $data);
    }
}
