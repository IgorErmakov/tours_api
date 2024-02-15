<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelRequest;
use App\Services\TravelCreator;

class TravelController extends Controller
{
    public function store(TravelCreator $travelCreator, CreateTravelRequest $request)
    {
        $input = $request->validated();
        $travel = $travelCreator->create($input);

        return response(['travel' => $travel->toArray()], 201);
    }
}
