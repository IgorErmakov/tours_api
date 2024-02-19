<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\Travel;
use App\Repositories\TourRepository;
use App\Repositories\TravelRepository;
use App\Services\TourRetrieval;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TourRetrievalTest extends TestCase
{
    public function test_that_service_passes_data_properly(): void
    {
        Carbon::setTestNow('2024-04-04 04:04:04');

        $this->instance(
            TravelRepository::class,
            Mockery::mock(TravelRepository::class, function (MockInterface $mock) {
                $travel = new Travel;
                $travel->id = 'travelId';
                $mock->shouldReceive('findPublicTravelBySlug')
                    ->with('slug')
                    ->once()
                    ->andReturn($travel);
            })
        );

        $this->instance(
            TourRepository::class,
            Mockery::mock(TourRepository::class, function (MockInterface $mock) {
                $mock->shouldReceive('findTours')
                    ->withArgs(function (
                        string $travelId,
                        int $page,
                        int $limit,
                        ?CarbonInterface $dateFrom,
                        ?CarbonInterface $dateTo,
                        int $priceFrom,
                        int $priceTo,
                        string $sort,
                        string $sortDirection
                    ) {
                        $this->assertSame('travelId', $travelId);
                        $this->assertSame(1, $page);
                        $this->assertSame('2024-04-04 04:04:04', $dateFrom->toDateTimeString());
                        $this->assertSame('2024-04-05 04:04:04', $dateTo->toDateTimeString());
                        $this->assertSame(100000, $priceFrom);
                        $this->assertSame(150000, $priceTo);
                        $this->assertSame('price', $sort);
                        $this->assertSame('asc', $sortDirection);

                        return true;
                    })
                    ->once();
            })
        );

        $service = $this->app->make(TourRetrieval::class);
        $service->findTours(
            'slug',
            1,
            now(),
            now()->addDay(),
            100000,
            150000,
            'price',
            'asc'
        );
    }
}
