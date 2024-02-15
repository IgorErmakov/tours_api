<?php

namespace Tests\Unit\Services;

use App\Repositories\TravelRepository;
use App\Services\TravelCreator;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class TravelCreatorTest extends TestCase
{
    public function test_that_service_passes_data_properly(): void
    {
        $data = [
            'name' => 'abc',
            'slug' => 'abc',
        ];

        $this->instance(
            TravelRepository::class,
            Mockery::mock(TravelRepository::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('create')
                    ->with($data)
                    ->once();
            })
        );

        $service = $this->app->make(TravelCreator::class);
        $service->create($data);
    }
}
