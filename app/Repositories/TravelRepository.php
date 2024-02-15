<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Travel;
use App\Repositories\Contracts\TravelRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TravelRepository implements TravelRepositoryInterface
{
    public function findItems(): Collection
    {
        return Travel::query()
//            ->where('project_id', $projectId)
            ->take(10)
            ->orderBy('priority')
            ->get();
    }

    public function create(array $data): Travel
    {
        $travel = new Travel;
        $travel->fill($data);
        $travel->save();

        return $travel;
    }
}
