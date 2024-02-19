<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;

class TourCreator
{
    public function __construct(protected TourRepositoryInterface $repository)
    {
    }

    public function create(array $data): Tour
    {
        return $this->repository->create($data);
    }
}
