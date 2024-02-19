<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use App\Services\TravelCreator;
use App\Services\TravelUpdater;

class TravelController extends Controller
{
    public function store(TravelCreator $travelCreator, CreateTravelRequest $request)
    {
        $travel = $travelCreator->create(
            $request->validated()
        );

        return response(['travel' => $travel->toArray()], 201);
    }

    public function update(string $id, TravelUpdater $travelUpdater, UpdateTravelRequest $request)
    {
        $travel = $travelUpdater->update(
            $id,
            $request->validated()
        );

        return response(['travel' => $travel->toArray()]);
    }
}
