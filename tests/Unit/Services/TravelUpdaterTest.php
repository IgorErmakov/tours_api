<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Repositories\TravelRepository;
use App\Services\TravelUpdater;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TravelUpdaterTest extends TestCase
{
    public function test_that_update_service_passes_data_properly(): void
    {
        $data = [
            'name' => 'abc',
            'slug' => 'abc',
        ];

        $this->instance(
            TravelRepository::class,
            Mockery::mock(TravelRepository::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('update')
                    ->with('travelId', $data)
                    ->once();
            })
        );

        $service = $this->app->make(TravelUpdater::class);
        $service->update('travelId', $data);
    }
}
