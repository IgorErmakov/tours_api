<?php
declare(strict_types=1);
namespace App\Repositories\Contracts;

use App\Models\Tour;

interface TourRepositoryInterface
{
    public function create(array $data): Tour;
    public function update(string $tourId, array $data): Tour;
}
