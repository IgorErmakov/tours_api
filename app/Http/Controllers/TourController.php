<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTourRequest;
use App\Http\Requests\IndexTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\TourResource;
use App\Services\TourCreator;
use App\Services\TourRetrieval;
use App\Services\TourUpdater;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class TourController extends Controller
{
    public function index(
        TourRetrieval $tourRetrieval,
        IndexTourRequest $request
    ) {
        $request->validated();

        $tours = $tourRetrieval->findTours(
            $request->slug,
            (int) $request->page,
            $request->dateFrom ? Carbon::parse($request->dateFrom) : null,
            $request->dateTo ? Carbon::parse($request->dateTo) : null,
            $request->priceFrom ? intval($request->priceFrom * 100) : 0,
            $request->priceTo ? intval($request->priceTo * 100) : 0,
            $request->sort,
            $request->sortDir === 'asc' ? 'asc' : 'desc',
        );

        return TourResource::collection($tours);
    }

    public function store(TourCreator $tourCreator, CreateTourRequest $request)
    {
        $tour = $tourCreator->create(
            $request->validated()
        );

        return response(['tour' => $tour->toArray()], Response::HTTP_CREATED);
    }

    public function update(string $id, TourUpdater $tourUpdater, UpdateTourRequest $request)
    {
        $tour = $tourUpdater->update(
            $id,
            $request->validated()
        );

        return response(['tour' => $tour->toArray()]);
    }
}
