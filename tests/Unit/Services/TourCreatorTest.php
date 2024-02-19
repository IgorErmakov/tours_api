<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Repositories\TourRepository;
use App\Services\TourCreator;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TourCreatorTest extends TestCase
{
    public function test_that_service_passes_data_properly(): void
    {
        $data = [
            'name' => 'abc',
            'travelId' => 'travelId',
        ];

        $this->instance(
            TourRepository::class,
            Mockery::mock(TourRepository::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('create')
                    ->with($data)
                    ->once();
            })
        );

        $service = $this->app->make(TourCreator::class);
        $service->create($data);
    }
}
