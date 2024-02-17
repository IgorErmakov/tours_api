<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Travel;

interface TravelRepositoryInterface
{
    public function findPublicTravelBySlug(string $slug): ?Travel;

    public function create(array $data): Travel;
}
