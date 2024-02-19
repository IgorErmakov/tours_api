<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelRequest;
use App\Services\TravelCreator;

class TravelController extends Controller
{
    public function store(TravelCreator $travelCreator, CreateTravelRequest $request)
    {
        $travel = $travelCreator->create(
            $request->validated()
        );

        return response(['travel' => $travel->toArray()], 201);
    }
}
