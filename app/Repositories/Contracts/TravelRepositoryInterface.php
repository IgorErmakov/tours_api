<?php
declare(strict_types=1);
namespace App\Repositories\Contracts;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Collection;

interface TravelRepositoryInterface
{
    public function findItems(): Collection;
    public function create(array $data): Travel;
}
