<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Travel;
use App\Repositories\Contracts\TravelRepositoryInterface;

class TravelCreator
{
    public function __construct(protected TravelRepositoryInterface $repository)
    {
    }

    public function create(array $data): Travel
    {
        return $this->repository->create($data);
    }
}
