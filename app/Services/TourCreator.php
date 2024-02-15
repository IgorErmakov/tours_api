<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;

class TourCreator
{
    public function __construct(protected TourRepositoryInterface $repository) {}

    public function create(array $data): Tour
    {
        // @todo igor: adds logs, creates events, etc..
        return $this->repository->create($data);
    }
}
