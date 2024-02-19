<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Repositories\TourRepository;
use App\Services\TourUpdater;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TourUpdaterTest extends TestCase
{
    public function test_that_update_service_passes_data_properly(): void
    {
        $data = [
            'name' => 'abc',
            'startingDate' => now(),
        ];

        $this->instance(
            TourRepository::class,
            Mockery::mock(TourRepository::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('update')
                    ->with('tourId', $data)
                    ->once();
            })
        );

        $service = $this->app->make(TourUpdater::class);
        $service->update('tourId', $data);
    }
}
