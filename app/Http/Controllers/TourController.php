<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexTourRequest;
use App\Http\Requests\CreateTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Repositories\TourRepository;
use App\Repositories\TravelRepository;
use App\Services\TourCreator;
use App\Services\TourUpdater;

class TourController extends Controller
{
    public function index(
        TravelRepository $travelRepository,
        TourRepository $tourRepository,
        IndexTourRequest $request
    ) {
        $request->validated();
        $travel = $travelRepository->findPublicTravelBySlug($request->slug);

        if (!$travel) {

            return response(['error' => 'Travel not found'], 422);
        }

        $tours = $tourRepository->findItems(
            $travel->id,
            $request->page,
            $request->dateFrom,
            $request->dateTo,
            $request->priceFrom * 100,
            $request->priceTo * 100,
            $request->sort,
            $request->sortDir,
        );

//        IndexService

        // @todo igor: add resource

        return response($tours, 200);
    }

    public function store(TourCreator $tourCreator, CreateTourRequest $request)
    {
        $input = $request->validated();
        $tour = $tourCreator->create($input);

        return response(['tour' => $tour->toArray()], 201);
    }

    public function update(string $id, TourUpdater $tourCreator, UpdateTourRequest $request)
    {
        $input = $request->validated();
        $tour = $tourCreator->update($id, $input);

        return response(['tour' => $tour->toArray()], 200);
    }
}
